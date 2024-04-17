<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerKalayang;


//Menu Kalayang CRUD
Route::post('/viewmenu',[ControllerKalayang::class,'viewmenu']);
Route::post('/savemenu',[ControllerKalayang::class,'makemenu']);
Route::post('/updatemenu',[ControllerKalayang::class,'updatemenu']);
Route::post('/deletemenu',[ControllerKalayang::class,'deletemenu']);
Route::post('/viewonemenu',[ControllerKalayang::class,'viewonemenu']);

