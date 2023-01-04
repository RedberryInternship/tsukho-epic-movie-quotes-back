<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterMail extends Mailable
{
	use Queueable, SerializesModels;

	public $route;

	public $name;

	public $subject;

	public function __construct($route, $name, $subject)
	{
		$this->route = $route;
		$this->name = $name;
		$this->subject = $subject;
	}

	public function build()
	{
		return $this->from(env('MAIL_USERNAME'), 'Movie Quotes')
		->subject($this->subject)
		->view('email.registration-email', ['name'=>$this->name, 'route' => $this->route]);
	}
}
