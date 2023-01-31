<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Tag;
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
	}
}
