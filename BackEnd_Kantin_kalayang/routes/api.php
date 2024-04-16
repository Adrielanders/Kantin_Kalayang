<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerKalayang;



Route::post('/viewallmenu',[ControllerKalayang::class,'viewmenu']);
Route::post('/savemenu',[ControllerKalayang::class,'makemenu']);

