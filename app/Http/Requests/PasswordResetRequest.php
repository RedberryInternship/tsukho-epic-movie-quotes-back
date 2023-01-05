<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
	public function rules()
	{
		return [
			'email' => 'required|email|exists:email,email',
		];
	}
}
