<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
{
	public function rules()
	{
		return [
			'password'              => 'required|regex:/^[a-z0-9_\-]+$/|min:8|max:15',
			'password_confirmation' => 'required|same:password',
		];
	}
}
