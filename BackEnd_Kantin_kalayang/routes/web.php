<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Mail\SendEmail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/testroute', function() {
    $name = "Funny Coder";

    Mail::to('testreceiver@gmail.com')->send(new SendEmail($name));
});