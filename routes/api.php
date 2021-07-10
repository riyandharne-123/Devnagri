<?php

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

Route::post('/login',[App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:api']],function(){
    Route::get('/verify/user',[App\Http\Controllers\AuthController::class, 'verify']);
    Route::post('/verify/permission',[App\Http\Controllers\AuthController::class, 'permission']);
});
