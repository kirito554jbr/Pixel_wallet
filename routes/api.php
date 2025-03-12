<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;

// use App\Http\Controllers\SocialiteController;

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

//Authentification

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    });


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::post('/logout', [AuthController::class, 'logout']);

// Route::get('/hello', [HelloController::class, 'test']);
Route::post('/hello', [HelloController::class, 'test']);


//Transaction
Route::post('/CreateTransaction', [TransactionController::class, 'create']);
Route::delete('/deleteTrans', [TransactionController::class, 'delete']);
Route::put('/updateTransactionStatus', [TransactionController::class, 'update']);


//Wallet
Route::put('/updateWallet', [WalletController::class, 'update']);
Route::get('/show', [WalletController::class, 'index']);

