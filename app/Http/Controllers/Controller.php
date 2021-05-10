<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $listTask = Task::all();
        $listMember = Member::all();
        $listPlan = array();
        foreach ($listTask as $item) {
            array_push($listPlan, ['id_task' => $item->id, 'memberOfTask' => Task::find($item->id)->members->pluck('name')]);
        }
        return view('home', compact(['listTask', 'listMember', 'listPlan']));
    }
}
