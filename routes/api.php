<?php

use App\Http\Controllers\API\TransaksiController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ObatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('transaksi', [TransaksiController::class, 'index']);
    Route::get('profile', [AuthController::class, 'fetch']);
    Route::get('obat', [ObatController::class, 'index']);
    Route::get('obat/tablet', [ObatController::class, 'filterTablet']);
    Route::get('obat/sirup', [ObatController::class, 'filterSirup']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
