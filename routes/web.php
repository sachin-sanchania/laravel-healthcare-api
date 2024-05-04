<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('auth-failed', function () {
    $errors = [];
    //array_push($errors, ['code' => '401', 'message' => 'Unauthenticated access.']);
    return response()->json([
        'success' => false,
        'error' => "Unauthorised access.",
        'code' => 401,
    ], 401);
})->name('auth-failed');
