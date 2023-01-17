<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieUpdateRequest extends FormRequest
{
	public function rules()
	{
		return [
			'id'             => 'required',
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
