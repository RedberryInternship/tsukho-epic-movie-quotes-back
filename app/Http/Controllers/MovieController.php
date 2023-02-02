<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieStoreRequest;
use App\Http\Requests\MovieUpdateRequest;
use App\Models\Movie;
use App\Models\MovieTag;
use App\Models\Tag;

class MovieController extends Controller
{
	public function index()
	{
		if (!is_null(request('lang')))
		{
			app()->setLocale(request('lang'));
		}

		$movies = Movie::where('user_id', auth()->user()->id)->filter(request(['search']))->withCount('quotes')
		->orderBy('created_at', 'desc')->get();

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

	public function names()
	{
		return Movie::where('user_id', auth()->user()->id)->select('movies.id', 'movies.name')->get();
	}

	public function store(MovieStoreRequest $request)
	{
		$data = $request->validated();

		if ($request->hasFile('image'))
		{
			$text['image'] = $request->file('image')
			->store('images', 'public');

			$data['image'] = asset('storage/' . $text['image']);
		}

		$movie = new Movie();

		$movie->setTranslation('name', 'en', $data['name-en'])
		->setTranslation('name', 'ka', $data['name-ka'])->setTranslation('director', 'en', $data['director-en'])
		->setTranslation('director', 'ka', $data['director-ka'])->setTranslation('description', 'en', $data['description-en'])
		->setTranslation('description', 'ka', $data['description-ka'])
		->setAttribute('image', $data['image'])->setAttribute('user_id', auth()->user()->id)->setAttribute('date', $data['date'])
		->setAttribute('budget', $data['budget'])
		->save();

		foreach (json_decode($data['tags']) as $tag)
		{
			MovieTag::create(['movie_id' => $movie->id, 'tag_id' => $tag]);
		}

		return response()->json(['message' => 'Movie created successfully'], 200);
	}

	public function put(MovieUpdateRequest $request)
	{
		$data = $request->validated();

		$newNameTranslations = ['en' => $data['name-ka'], 'ka' => $data['name-en']];

		$newDirectorTranslations = ['en' => $data['director-ka'], 'ka' => $data['director-en']];

		$newDescriptionTranslations = ['en' => $data['description-ka'], 'ka' => $data['description-en']];

		if ($request->hasFile('image'))
		{
			$text['image'] = $request->file('image')
			->store('images', 'public');

			$data['image'] = asset('storage/' . $text['image']);
		}

		$movie = Movie::find($data['id']);

		$movie->replaceTranslations('name', $newNameTranslations)->replaceTranslations('director', $newDirectorTranslations)
		->replaceTranslations('description', $newDescriptionTranslations)
		->setAttribute('image', $data['image'])->setAttribute('user_id', auth()->user()->id)->setAttribute('date', $data['date'])
		->save();

		MovieTag::where('movie_id', $data['id'])->delete();

		foreach (json_decode($data['tags']) as $tag)
		{
			MovieTag::create(['movie_id' => $movie->id, 'tag_id' => $tag]);
		}

		return response()->json(['message' => 'movie data updated successfully'], 200);
	}

	public function destroy(Movie $id)
	{
		$id->delete();

		return response()->json(['message' => 'movie deleted successfully'], 200);
	}
}
