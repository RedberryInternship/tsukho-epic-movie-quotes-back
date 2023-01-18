<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLoginController;
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

Route::middleware('auth:sanctum')->group(function () {
	Route::group(['controller' => UserLoginController::class], function () {
		Route::get('/logout', 'logout')->name('user-login.logout');
		Route::get('/user-info', 'userInfo')->name('user-login.user-info');
	});

	Route::group(['controller' => MovieController::class], function () {
		Route::get('/movies', 'index')->name('movie.index');
		Route::get('/movie/{id}', 'show')->name('movie.show');
		Route::get('/movie-genres', 'genres')->name('movie.genres');
		Route::post('/create-movie', 'store')->name('movie.store');
		Route::put('/update-movie', 'put')->name('movie.put');
		Route::delete('/delete-movie/{id}', 'destroy')->name('movie.destroy');
	});

	Route::group(['controller' => QuoteController::class], function () {
		Route::get('/quotes', 'index')->name('quote.index');
		Route::get('/quote/{id}', 'show')->name('quote.show');
		Route::post('/create-quote', 'store')->name('quote.store');
		Route::put('/update-quote', 'put')->name('quote.put');
		Route::delete('/delete-quote/{id}', 'destroy')->name('quote.destroy');
	});

	Route::group(['controller' => CommentController::class], function () {
		Route::post('/create-comment', 'store')->name('comment.store');
	});

	Route::group(['controller' => LikeController::class], function () {
		Route::post('/store-or-destroy/{id}', 'storeOrDestroy')->name('quote.storeOrDestroy');
	});
});

Route::middleware('guest')->group(function () {
	Route::group(['controller' => UserController::class], function () {
		Route::post('/register', 'register')->name('user.register');
		Route::post('/password-reset', 'passwordReset')->name('user.password-reset');
		Route::post('/password-verify', 'verifyPasswordReset')->name('user.password-verify');
		Route::get('/verify', 'emailVerify')->name('user.verify');
	});

	Route::group(['controller' => UserLoginController::class], function () {
		Route::post('/login', 'login')->name('user-login.login');
	});
});
