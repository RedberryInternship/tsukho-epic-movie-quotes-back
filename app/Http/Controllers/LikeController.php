<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Quote;

class LikeController extends Controller
{
	public function storeOrDestroy(Quote $id)
	{
		$like = $id->likes()->where('user_id', auth()->user()->id)->first();

		if ($like)
		{
			$like->delete();

			return response()->json(['message' => 'like removed successfully'], 201);
		}

		$data = ['quote_id' => $id->id, 'user_id' => auth()->user()->id];

		Like::create($data);

		return response()->json(['message' => 'like was created successfully'], 201);
	}
}
