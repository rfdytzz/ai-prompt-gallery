<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {

    Mail::raw('Halo dari Laravel', function ($message) {

        $message->to('test@gmail.com')
                ->subject('Test Email');

    });

    return 'Email terkirim';
});