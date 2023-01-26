<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Mail\VerificationMail;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class EmailController extends Controller
{
	public function store(EmailVerificationRequest $request)
	{
		$data = $request->validated();

		if (!is_null(request('lang')))
		{
			app()->setLocale(request('lang'));
		}

		$token = sha1(time());

		$emailData = ['email' => $data['email'], 'is_primary' => false, 'user_id' => auth()->user()->id, 'verification_token' => $token];

		Email::create($emailData);

		$route = URL::temporarySignedRoute(
			'email.email-verify',
			now()->addMinutes(30),
			['token' => $token],
		);

		$frontUrl = config('app.front-url') . request('lang') . '/profile/' . '?verification-link=' . $route;

		Mail::to($data['email'])->send(new VerificationMail($frontUrl, auth()->user()->name, __('email.email-verification'), __('email.email-verification-text'), __('email.email-verify-button')));

		return response()->json('Email verification email sent successfully', 201);
	}

	public function makePrimary(Email $id)
	{
		$previousPrimary = Email::where([['is_primary', true], ['user_id', auth()->user()->id]])->first();

		$previousPrimary->setAttribute('is_primary', false)->save();

		$id->setAttribute('is_primary', true)->save();

		return response()->json(['message' => 'primary email updated successfully'], 200);
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

	public function destroy(Email $id)
	{
		$id->delete();

		return response()->json(['message' => 'email deleted successfully'], 200);
	}
}
