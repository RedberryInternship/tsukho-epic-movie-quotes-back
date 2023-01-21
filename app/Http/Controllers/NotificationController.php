<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
	public function index()
	{
		$notifications = Notification::where('user_id', auth()->user()->id)->get();

		return response()->json($notifications, 200);
	}
}
