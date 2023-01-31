<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmailFactory extends Factory
{
	public function definition()
	{
		return [
			'email'                 => fake()->unique()->safeEmail(),
			'email_verified_at'     => now(),
			'verification_token'    => Str::random(10),
			'is_primary'            => true,
			'user_id'               => 1,
		];
	}
}
