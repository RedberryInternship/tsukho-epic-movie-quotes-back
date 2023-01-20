<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;
use App\Models\Notification;
use App\Models\Quote;

class CommentController extends Controller
{
	public function store(CommentStoreRequest $request)
	{
		$data = $request->validated();

		Comment::create([...$data, 'user_id' => auth()->user()->id]);

		$userId = Quote::find($data['quote_id'])->movie->user_id;

		if ($userId !== auth()->user()->id)
		{
			Notification::create(
				[
					'user_id'    => $userId,
					'person_id'  => auth()->user()->id,
					'is_new'     => true,
					'is_comment' => true,
					'quote_id'   => $data['quote_id'],
				]
			);
		}

		return response()->json(['message' => 'comment was created successfully'], 200);
	}
}
