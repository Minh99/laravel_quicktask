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
        $data_task = $request->all();

        $id_task = $data_task['id_task'];
        $listIdMemberOfTask = Task::find($id_task)->members->pluck('id');
        $dataMemberNotExistInTask = array();
        foreach ($data_task as $key => $value) {
            if ($key == '_token' || $key == 'id_task') {
                continue;
            }
            if (!$listIdMemberOfTask->contains($value)) {
                array_push($dataMemberNotExistInTask, ['task_id'=>$id_task, 'member_id'=>$value]);
            }
        }
        
        if(count($dataMemberNotExistInTask) == 0){

            return back()->withInput()->with('status', trans('nothingChanges'));
        }

        // chạy Transaction 
        DB::beginTransaction();
        try {
            DB::table('plans')->insert($dataMemberNotExistInTask);
            DB::commit();

            return back()->withInput()->with('status', trans('insertSuccessPlan'));
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('status', trans('insertFailePlan'));
        }
    }

    public function delete($id_task)
    {
        $listPlanHaveInTask = Plan::where('task_id', "=", $id_task)->get();

        if(count($listPlanHaveInTask ) == 0){

            return back()->withInput()->with('status', trans('taskHasNoMember'));
        }
        
        $listIdPlan = array();
        foreach($listPlanHaveInTask as $value){
            array_push($listIdPlan, $value->id);
        }

        // chạy Transaction 
        DB::beginTransaction();
        try {
            Plan::destroy($listIdPlan);
            DB::commit();

            return back()->withInput()->with('status', trans('deleteSuccessPlan'));
        } catch (Exception $e) {
            DB::rollBack();

            return back()->withInput()->with('status', trans('deleteFailePlan'));
        }
    }
}
