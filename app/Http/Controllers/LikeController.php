<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreOrDestroyRequest;
use App\Models\Like;
use App\Models\Notification;
use App\Models\Quote;

class LikeController extends Controller
{
	public function storeOrDestroy(Quote $id, LikeStoreOrDestroyRequest $request)
	{
		$response = $request->validated();

		$like = $id->likes()->where('user_id', auth()->user()->id)->first();

		if ($like)
		{
			$like->delete();

			return response()->json(['message' => 'like removed successfully'], 201);
		}

		$data = ['quote_id' => $id->id, 'user_id' => auth()->user()->id];

		Like::create($data);

		if ($response['user_id'] !== auth()->user()->id)
		{
			Notification::create(
				[
					'user_id'    => $response['user_id'],
					'person_id'  => auth()->user()->id,
					'is_new'     => true,
					'is_comment' => false,
					'quote_id'   => $id->id,
				]
			);
		}

		return response()->json(['message' => 'like was created successfully'], 201);
	}
}
