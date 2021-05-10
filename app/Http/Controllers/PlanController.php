<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $data_task = $request->all(); // láy tất cả các thuộc tính có value nếu tồn tại

        // kiểm tra xem có bị trùng lặp thành viên hay không 
        // (kiểm tra từ vị trí thứ 2 trở đi) (vị trí 0 là token, vị trí 1 là id_task)
        // nếu trùng lặp -> bỏ qua
        // nếu không trùng lặp -> thêm thành viên vào task này

        $id_task = $data_task['id_task'];
        $listIdMemberOfTask = Task::find($id_task)->members->pluck('id');
        $dataMemberNotExistInTask = array();
        foreach ($data_task as $key => $value) {
            if ($key == '_token' || $key == 'id_task') {
                continue;
            }
            if (!$listIdMemberOfTask->contains($value)) {
                array_push($dataMemberNotExistInTask,['task_id'=>$id_task,'member_id'=>$value]);
            }
        }
        
        // kiểm tra số lượng thành viên không bị trùng lặp
        if(count($dataMemberNotExistInTask) == 0){
            return back()->withInput()->with('status',__('nothingChanges'));
        }

        // chạy Transaction 
        DB::beginTransaction();
        try {
            DB::table('plans')->insert($dataMemberNotExistInTask);
            DB::commit();

            return back()->withInput()->with('status',__('insertSuccessPlan'));
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('status',__('insertFailePlan'));
        }
    }

    public function delete($id_task)
    {
        // tìm và xoá tất cả các id_plan mà có id_task = $id_task
        $listPlanHaveInTask = Plan::where('task_id',"=",$id_task)->get();

        // kiểm tra xem task_id này có thành viên nào không
        if(count($listPlanHaveInTask ) == 0){

            return back()->withInput()->with('status',__('taskHasNoMember'));
        }
        
        $listIdPlan = array();
        foreach($listPlanHaveInTask as $value){
            array_push($listIdPlan,$value->id);
        }

        // chạy Transaction 
        DB::beginTransaction();
        try {
            Plan::destroy($listIdPlan);
            DB::commit();

            return back()->withInput()->with('status',__('deleteSuccessPlan'));
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('status',__('deleteFailePlan'));
        }
    }
}
