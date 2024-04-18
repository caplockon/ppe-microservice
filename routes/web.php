<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    if (app()->isLocal()) {
        phpinfo();
        return null;
    }

    return response('Not Found', 404);
});
