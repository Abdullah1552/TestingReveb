<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

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


Route::group(['prefix' => 'auth'], function() {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('forget-password', [UserController::class, 'forgetPassword'])->name('forget.password.post');
    Route::post('reset-password', [UserController::class, 'resetPassword'])->name('reset.password.post');
    Route::post('forget-password/confirm-OTP', [UserController::class, 'confirmOTP'])->name('reset.password.post');
});



Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::get('details', [UserController::class, 'details']);
    Route::post('logout',[UserController::class, 'logoutApi']);
});

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
