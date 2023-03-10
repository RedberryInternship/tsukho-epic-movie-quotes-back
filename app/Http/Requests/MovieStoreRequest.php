<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
{
	public function rules()
	{
		return [
			'name-ka'        => 'required',
			'name-en'        => 'required',
			'tags'           => 'required',
			'date'           => 'required',
			'director-ka'    => 'required',
			'director-en'    => 'required',
			'description-ka' => 'required',
			'description-en' => 'required',
			'image'          => 'required',
			'budget'         => 'required',
		];
	}
}
