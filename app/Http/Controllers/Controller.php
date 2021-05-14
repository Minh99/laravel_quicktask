<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function show($option)
    {
        $listTask = Task::all(); 
        $listMember = Member::all();
        $listPlan = array();
        foreach ($listTask as $item) {
            array_push($listPlan, ['id_task' => $item->id, 'name_task' => $item->name, 'memberOfTask' => Task::find($item->id)->members->pluck('name')]);
        }

        if($option == 'task'){
            $listTask = Task::paginate(Config::get('variable.num_paginate')); 

            return view('pages.viewTask', compact(['listTask']));
        }
        else if($option == 'member'){
            $listMember = Member::paginate(Config::get('variable.num_paginate'));

            return view('pages.viewMember', compact(['listMember']));
        }
        return view('pages.viewPlan', compact(['listTask', 'listMember', 'listPlan']));
    }
}
