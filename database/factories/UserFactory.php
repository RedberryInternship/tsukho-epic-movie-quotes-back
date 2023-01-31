<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
	public function definition()
	{
		return [
			'name'              => fake()->name(),
			'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
			'remember_token'    => Str::random(10),
			'image'             => asset('imgs/default.png'),
			'google_id'         => null,
		];
	}
}
