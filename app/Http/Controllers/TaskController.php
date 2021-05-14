<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        $newTask = new Task();
        $newTask->name = ucwords($name);
        if (!$newTask->save()) {

            return back()->withInput()->with('status', trans('insertFaileTask'));
        }

        return back()->withInput()->with('status', trans('insertSuccessTask'));
    }

    public function delete($id_task)
    {
        $task = Task::find($id_task);
        if (!$task->delete()) {
            
            return back()->withInput()->with('status', trans('deleteFaileTask'));
        }

        return back()->withInput()->with('status', trans('deleteSuccessTask'));
    }
}