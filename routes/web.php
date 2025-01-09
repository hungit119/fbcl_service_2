<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('submit-forgot-password', [UserController::class, 'submitForgotPassword']);
Route::post('confirm-forgot-password/{user_id}', [UserController::class, 'confirmForgotPassword'])->name('confirmForgotPassword');

Route::get('/preview/forgot-password', function () {
    $token = new \App\Services\Jwt\JwtService();
    $jwt = $token->createJwtToken([
        'user_id' => 1
    ]);
    return new \App\Mail\ForgotPasswordEmail([
        'code' => rand(100000, 999999),
        'fullname' => "Trần Duy Hùng",
        'url' => Config('environment.ROOT_DOMAIN') . '/submit-forgot-password?token='.$jwt
    ]);
});
