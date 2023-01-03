<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\RegisterMail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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

		$token = sha1(time());

		$emailData = ['email' => $request->email, 'is_primary' => true, 'user_id' => $user->id, 'verification_token' => $token];

		Email::create($emailData);

		$route = URL::temporarySignedRoute(
			'user.verify',
			now()->addMinutes(30),
			['token' => $token],
		);

		Mail::to($request->email)->send(new RegisterMail($route, $request->name, 'Account Verification'));

		return $user;
	}

	public function passwordReset(PasswordResetRequest $request)
	{
		return $request;
	}

	public function emailVerify(Request $request)
	{
		if (!$request->hasValidSignature())
		{
			abort(401);
		}

		return 'sdsad';
	}
}
