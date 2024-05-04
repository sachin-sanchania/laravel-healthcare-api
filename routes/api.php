<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware('auth:sanctum')->group( function () {
    Route::post('appointment',[\App\Http\Controllers\AppointmentController::class,'store']);
    Route::post('appointment/view',[\App\Http\Controllers\AppointmentController::class,'view']);
    Route::post('appointment/cancel',[\App\Http\Controllers\AppointmentController::class,'cancel']);
    Route::post('get-healthcare-professionals',[\App\Http\Controllers\HealthcareProfessionalController::class,'lists']);
    Route::post('logout',[\App\Http\Controllers\UserAuthController::class,'logout']);
});
Route::post('register',[\App\Http\Controllers\UserAuthController::class,'register']);
Route::post('login',[\App\Http\Controllers\UserAuthController::class,'login']);
