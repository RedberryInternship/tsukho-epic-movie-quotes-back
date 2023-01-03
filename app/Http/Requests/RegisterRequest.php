<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name'                  => 'required|unique:users,name|min:3|max:15|regex:/^[a-z0-9_\-]+$/',
			'email'                 => 'required|email|unique:email,email',
			'password'              => 'required|regex:/^[a-z0-9_\-]+$/|min:8|max:15',
			'password_confirmation' => 'required|same:password',
		];
	}
}
