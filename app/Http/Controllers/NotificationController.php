<?php

namespace App\Http\Controllers;

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
}
