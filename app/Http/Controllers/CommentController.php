<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Comment;

class CommentController extends Controller
{
	public function store(CommentStoreRequest $request)
	{
		$data = $request->validated();

		Comment::create([...$data, 'user_id' => auth()->user()->id]);

		return response()->json(['message' => 'comment was created successfully'], 200);
	}
}
