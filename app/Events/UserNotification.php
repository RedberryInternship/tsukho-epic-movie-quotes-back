<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserNotification implements ShouldBroadcast
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public $notifications;

	public function __construct($notifications)
	{
		$this->notifications = $notifications;
	}

	public function broadcastOn()
	{
		return new PrivateChannel('epic-movies.' . $this->notifications['user_id']);
	}

	public function broadcastAs()
	{
		return 'notifications';
	}
}
