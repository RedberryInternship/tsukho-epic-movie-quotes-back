<?php

namespace App\Http\Controllers;

use App\Http\Requests\NotificationUpdateRequest;
use App\Models\Notification;

class NotificationController extends Controller
{
	public function index()
	{
		$notifications = Notification::where('user_id', auth()->user()->id)
		->with(['person' => function ($person) {
			return $person->select('id', 'image', 'name');
		}, 'quote' => function ($quote) {
			return $quote->select('id', 'movie_id');
		}])
		->orderBy('created_at', 'desc')->get();

		return response()->json($notifications, 200);
	}

	public function put(NotificationUpdateRequest $request)
	{
		$data = $request->validated();

		if (count($data['ids']) > 0)
		{
			foreach ($data['ids'] as $each)
			{
				Notification::where('id', $each)->update(['is_new' => false]);
			}
		}

		return response()->json(['message' => 'notifications updated successfully'], 200);
	}
}
