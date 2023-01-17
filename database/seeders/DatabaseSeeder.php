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
			$movieTags = new Tag();

			$movieTags->setTranslation('tags', 'en', $genre['en'])->setTranslation('tags', 'ka', $genre['ka'])->save();
		}
	}
}
