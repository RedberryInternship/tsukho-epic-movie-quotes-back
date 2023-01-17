<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use Spatie\Translatable\HasTranslations;
use App\Models\Movie;
use App\Models\Tag;

class MovieController extends Controller
{
	use HasTranslations;

	public $translatable = ['name', 'director', 'description'];

	public function index()
	{
		$movies = Movie::where('user_id', auth()->user()->id)->filter(request(['search']))->withCount('quotes')->get();

		return response()->json($movies, 200);
	}

	public function show($id)
	{
		$movie = Movie::where('id', $id)->with(['quotes' => function ($quote) {
			return $quote->withCount(['likes', 'comments']);
		}, 'tags' => function ($tag) {
			return $tag->select('tags.id', 'tags.tags');
		}])->first();

		if (!$movie)
		{
			return response()->json(['message' => 'movie was not found'], 404);
		}

		return response()->json($movie, 200);
	}

	public function genres()
	{
		return response()->json(Tag::all(), 200);
	}

	public function store(MovieStoreRequest $request)
	{
		$data = $request->validated();

		if ($request->hasFile('image'))
		{
			$text['image'] = $request->file('image')
			->store('images', 'public');
		}

		$movie = new Movie();

		$movie->setTranslation('name', 'en', $data['name-en'])
		->setTranslation('name', 'ka', $data['name-ka'])->setTranslation('director', 'en', $data['director-en'])
		->setTranslation('director', 'ka', $data['director-ka'])->setTranslation('description', 'en', $data['description-ka'])
		->setTranslation('description', 'ka', $data['description-ka'])
		->setAttribute('image', $data['image'])->setAttribute('user_id', auth()->user()->id)->setAttribute('date', $data['date'])
		->setAttribute('budget', $data['budget'])
		->save();

		return response()->json(['message' => 'Movie created successfully'], 200);
	}

	public function put(MovieStoreRequest $request, Movie $id)
	{
		$data = $request->validated();

		$newNameTranslations = ['en' => $data['name-ka'], 'ka' => $data['name-en']];

		$newDirectorTranslations = ['en' => $data['director-ka'], 'ka' => $data['director-en']];

		$newDescriptionTranslations = ['en' => $data['description-ka'], 'ka' => $data['description-en']];

		$id->replaceTranslations('name', $newNameTranslations)->replaceTranslations('director', $newDirectorTranslations)
		->replaceTranslations('description', $newDescriptionTranslations)->setAttribute('genres', $data['genres'])
		->setAttribute('image', $data['image'])->setAttribute('user_id', auth()->user()->id)->setAttribute('date', $data['date'])
		->save();

		return response()->json(['message' => 'movie data updated successfully'], 200);
	}

	public function destroy(Movie $id)
	{
		$id->delete();

		return response()->json(['message' => 'movie deleted successfully'], 200);
	}
}
