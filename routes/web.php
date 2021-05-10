<?php
use Illuminate\Support\Facades\Route;

Route::get('/',[Controller::class,'index'])->name('home');
