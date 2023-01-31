<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
	public function definition()
	{
		return [
			'movie_id' => 1,
			'quote'    => [
				'en' => fake()->sentence(),
				'ka' => fake()->sentence(),
			],
			'image'    => asset('imgs/default.png'),
		];
	}
}
