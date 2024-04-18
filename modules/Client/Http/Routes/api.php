<?php

use App\Http\Middleware\ApiKeyAuthentication;
use Illuminate\Support\Facades\Route;
use Modules\Client\Http\Controllers\ClientController;

Route::group(['prefix' => 'api/clients', 'middleware' => [ApiKeyAuthentication::class]], function () {
    Route::post('/subscribe', [ClientController::class, 'subscribe']);
});
