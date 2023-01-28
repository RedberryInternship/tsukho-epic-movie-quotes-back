<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
	public function redirect($locale, $type)
	{
		return Socialite::driver('google')->stateless()
		->redirectUrl(config('services.google.redirect') . '/' . $locale . '?type=' . $type)
		->redirect()->getTargetUrl();
	}

	public function verifyUser($locale, $type)
	{
		config([
			'services.google.redirect' => config('services.google.redirect') . '/' . $locale . '?type=' . $type,
		]);

		$user = Socialite::driver('google')->stateless()->user();

		$checkEmail = Email::where('email', $user->email)->first();

		if ($checkEmail)
		{
			$hasPassword = Email::where('email', $user->email)->first()->user->password;

			if ($hasPassword)
			{
				return response()->json(['message' => 'user already exists'], 404);
			}

			Auth::loginUsingId($checkEmail->user->id);
			request()->session()->regenerate();
			return response()->json(['user' => auth()->user()], 200);
		}

		$newUser = User::create([
			'name'      => $user->name,
			'google_id' => $user->id,
			'image'     => $user->avatar,
		]);

		Email::create([
			'email'             => $user->email,
			'user_id'           => $newUser->id,
			'email_verified_at' => now(),
			'primary'           => true,
		]);

		Auth::loginUsingId($newUser->id);
		request()->session()->regenerate();
		return response()->json(['user' => auth()->user()], 200);
	}
}
