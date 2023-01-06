<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserLoginController extends Controller
{
	public function login(LoginRequest $request)
	{
		$login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

		if ($login_type === 'email')
		{
			$email = Email::where('email', $request->login)->first();

			if ($email === null)
			{
				return response()->json(['message' => 'User not found'], 401);
			}

			if ($email->email_verified_at === null)
			{
				return response()->json(['message' => 'Email is not verified'], 422);
			}

			$user = $email->user;
		}

		if ($login_type === 'name')
		{
			$user = User::where('name', $request->login)->first();
		}

		if ($user === null)
		{
			return response()->json(['message' => 'User not found'], 401);
		}

		if (auth()->validate(['id' => $user->id, 'password' => $request->password]))
		{
			Auth::loginUsingId($user->id, $request->remember);
			return response()->json(['user' => auth()->user()], 200);
			request()->session()->regenerate();
		}

		return response()->json(['message' => 'Invalid credentials'], 401);
	}

	public function logout()
	{
		auth()->logout();
		request()->session()->invalidate();
		request()->session()->regenerateToken();

		return response()->json(['message' => 'User logged out successfully'], 201);
	}
}
