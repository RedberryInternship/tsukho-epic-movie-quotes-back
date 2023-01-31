<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Email;
use App\Models\Movie;
use App\Models\Notification;
use App\Models\Quote;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
		foreach (config('genres.genres') as $genre)
		{
			Tag::factory()->create(['tags' => [
				'en' => $genre['en'],
				'ka' => $genre['ka'],
			]]);
		}

		$userOne = User::factory()->create();
		$userTwo = User::factory()->create();

		Email::factory()->create(['user_id' => $userOne->id]);
		Email::factory()->create(['user_id' => $userTwo->id]);

		$movieOne = Movie::factory()->create(['user_id' => $userOne->id]);
		$movieTwo = Movie::factory()->create(['user_id' => $userTwo->id]);

		$quoteOne = Quote::factory()->create(['movie_id' => $movieOne->id]);
		$quoteTwo = Quote::factory()->create(['movie_id' => $movieTwo->id]);

		Notification::factory()->create([
			'user_id'     => $userOne->id,
			'person_id'   => $userTwo->id,
			'quote_id'    => $quoteOne->id,
		]);
		Notification::factory()->create([
			'user_id'     => $userTwo->id,
			'person_id'   => $userOne->id,
			'quote_id'    => $quoteTwo->id,
		]);
	}
}
