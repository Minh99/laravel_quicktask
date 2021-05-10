<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\I18nController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('i18n/{option}',[I18nController::class,'changes'])->name('i18n');

Route::get('show/{option}',[Controller::class,'show'])->name('show');

Route::post('member/create',[MemberController::class,'create'])->name('member.create');
Route::delete('member/delete/{id_member}',[MemberController::class,'delete'])->name('member.delete');

Route::post('task/create',[TaskController::class,'create'])->name('task.create');
Route::delete('task/delete/{id_task}',[TaskController::class,'delete'])->name('task.delete');

Route::post('plan/createOrUpdate',[PlanController::class,'createOrUpdate'])->name('plan.createOrUpdate');
Route::delete('plan/delete/{id_task}',[PlanController::class,'delete'])->name('plan.delete');
