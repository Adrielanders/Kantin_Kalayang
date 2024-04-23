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

//Transaksi Kalayang CRUD
Route::post('/viewtransaksi',[ControllerKalayang::class,'viewtransaksi']);
Route::post('/savetransaksi',[ControllerKalayang::class,'savetransaksi']);
Route::post('/viewrekap',[ControllerKalayang::class,'viewrekap']);
Route::post('/detailrekap',[ControllerKalayang::class,'detailrekap']);

//Akun Penjual Kalayang CRUD
Route::post('/savedata',[ControllerKalayang::class,'savedatapenjual']);
Route::post('/generatepassword',[ControllerKalayang::class,'savedatapenjual']);
//Mail
Route::post('/user/mail/send', [ControllerKalayang::class, 'sendemail']);