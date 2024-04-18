<?php
declare(strict_types=1);

use App\Http\Middleware\ApiKeyAuthentication;
use Illuminate\Support\Facades\Route;
use Modules\Logging\Http\Controllers\ApiLogController;

Route::group(['prefix' => 'api/logging/api-log', 'middleware' => [ApiKeyAuthentication::class]], function () {

    Route::post('/test', [ApiLogController::class, 'test']);

    Route::get('/', [ApiLogController::class, 'list']);
});
