<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuoteRequest extends FormRequest
{
	public function rules()
	{
		return [
			'id'       => 'required',
			'quote-en' => 'required',
			'quote-ka' => 'required',
			'image'    => 'required',
		];
	}
}
