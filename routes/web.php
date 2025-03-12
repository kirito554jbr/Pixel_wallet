<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Models\Transaction;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', [HelloController::class, 'test']);

Route::get('/register', [AuthController::class, 'register']);

Route::get('/walletTese', [AuthController::class, 'createWallet']);

Route::get('/testTransaction', [TransactionController::class, 'create']);


Route::get('/createWallet', [WalletController::class, 'create']);

Route::get('/deleteUser', [UserController::class, 'delete']);

Route::get('/deleteTrans', [TransactionController::class, 'delete']);



