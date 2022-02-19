<?php

use App\Http\Controllers\AuthController;
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

Route::post('signin', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'registrasi']);



Route::middleware(['auth:sanctum'])->group(function () {
    
    Route::get('getData', [AuthController::class, 'fetch']);
    Route::put('updateProfilePut/{id}/update', [AuthController::class, 'updateProfilePut']);
    Route::post('updateProfilePost', [AuthController::class, 'updateProfilePost']);
    Route::delete('destroy/{id}/delete', [AuthController::class, 'destroy']);

});
