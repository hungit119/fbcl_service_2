<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    //    auth
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);
    Route::post('forgot-password', [UserController::class, 'forgotPassword']);
    Route::group(['middleware' => ['verifyTokenApp']], function () {
        Route::post('update-user-by-params', [UserController::class, 'updateUserByParams']);
    });

    Route::group(['middleware' => ['verifyToken']], function () {
        // post
        Route::post('create-post', [PostController::class, 'createPost']);
        Route::get('get-list-post', [PostController::class, 'getListPost']);
        // user
        Route::get('get-user-info', [UserController::class, 'getUserInfo']);
    });
});
