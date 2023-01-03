<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class UserController extends Controller
{
	public function login(LoginRequest $request)
	{
		return $request;
	}

	public function register(RegisterRequest $request)
	{
		$data = ['name' => $request->name, 'password' => bcrypt($request->password), 'image' => asset('storage/images/default.png')];

		$user = User::create($data);

		return $user;
	}

	public function passwordReset(PasswordResetRequest $request)
	{
		return $request;
	}
}
