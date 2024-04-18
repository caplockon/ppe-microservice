<?php

use App\Http\Middleware\ApiKeyAuthentication;
use Illuminate\Support\Facades\Route;
use Modules\Pricing\Http\Controllers\PricingController;

Route::group(['prefix' => 'api/pricing', 'middleware' => [ApiKeyAuthentication::class]], function () {
    Route::post('/search', [PricingController::class, 'search']);
});
