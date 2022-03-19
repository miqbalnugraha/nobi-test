<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\QuoteController;
use App\Http\Controllers\API\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function(){
    Route::post('auth/register', [AuthController::class, 'register']);
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::get('/quote', [QuoteController::class, 'index']);
});


Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
      Route::post('/transaction', [TransactionController::class, 'transaction']);
      Route::post('/price/upload', [TransactionController::class, 'import']);
   });


