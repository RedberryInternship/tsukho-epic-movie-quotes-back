<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewPasswordRequest;
use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\RegisterRequest;
use App\Mail\VerificationMail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{
	public function register(RegisterRequest $request)
	{
		if (!is_null(request('lang')))
		{
			app()->setLocale(request('lang'));
		}

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

		$frontUrl = config('app.front-url') . request('lang') . '?register-link=' . $route;

		Mail::to($request->email)->send(new VerificationMail($frontUrl, $request->name, __('email.account-verification'), __('email.joining-text'), __('email.verify-button')));

		return response()->json('Email verification email sent successfully', 201);
	}

	public function emailVerify(Request $request)
	{
		if (!$request->hasValidSignature())
		{
			abort(401);
		}

		$email = Email::where('verification_token', $request->token)->first();

		if ($email->email_verified_at)
		{
			return response()->json('email is already verified', 422);
		}

		$email->email_verified_at = now();

		$email->save();

		return response()->json('Email verified successfully', 201);
	}

	public function passwordReset(PasswordResetRequest $request)
	{
		if (!is_null(request('lang')))
		{
			app()->setLocale(request('lang'));
		}

		$email = Email::where('email', $request->email)->first();

		if ($email->email_verified_at === null)
		{
			return response()->json(['message' => __('email.email-not-verified')], 422);
		}

		$token = sha1(time());

		$email->verification_token = $token;

		$route = URL::temporarySignedRoute(
			'user.password-verify',
			now()->addMinutes(30),
			['token' => $token],
		);

		$frontUrl = config('app.front-url') . request('lang') . '?reset-link=' . $route;

		Mail::to($request->email)->send(new VerificationMail($frontUrl, $request->name, __('email.password-reset'), __('email.reset-text'), __('email.reset-button')));

		$email->save();
		return response()->json('Password reset email sent successfully', 201);
	}

	public function verifyPasswordReset(NewPasswordRequest $request)
	{
		if (!$request->hasValidSignature())
		{
			abort(401);
		}

		$user = Email::where('verification_token', $request->token)->first()->user;

		$user->password = bcrypt($request->password);

		$user->save();

		return response()->json('User password changed successfully', 201);
	}
}
