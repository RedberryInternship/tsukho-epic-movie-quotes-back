<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
	public function definition()
	{
		return [
			'user_id'        => 1,
			'date'           => 2000,
			'budget'         => 200000,
			'director'       => [
				'en' => fake()->name(),
				'ka' => fake()->name(),
			],
			'description'    => [
				'en' => fake()->text(),
				'ka' => fake()->text(),
			],
			'name'           => [
				'en' => fake()->name(),
				'ka' => fake()->name(),
			],
			'image'          => asset('imgs/default.png'),
		];
	}
}
