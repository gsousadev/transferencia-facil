<?php

use Application\Http\Controllers\ShopkeeperController;
use Application\Http\Controllers\TransactionController;
use Application\Http\Controllers\UserController;
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

Route::post('/transaction', TransactionController::class . '@store');
Route::get('/transaction', TransactionController::class . '@find');
Route::get('/users', UserController::class . '@find');
Route::get('/shopkeepers', ShopkeeperController::class . '@find');
