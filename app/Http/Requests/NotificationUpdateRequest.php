<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationUpdateRequest extends FormRequest
{
	public function rules()
	{
		return [
			'ids' => 'array',
		];
	}
}
