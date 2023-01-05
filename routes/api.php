<?php

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

Route::middleware('guest')->group(function () {
	Route::group(['controller' => UserController::class], function () {
		Route::post('/login', 'login')->name('user.login');
		Route::post('/register', 'register')->name('user.register');
		Route::post('/password-reset', 'passwordReset')->name('user.password-reset');
		Route::post('password-verify', 'verifyPasswordReset')->name('user.password-verify');
		Route::get('/verify', 'emailVerify')->name('user.verify');
	});
});
