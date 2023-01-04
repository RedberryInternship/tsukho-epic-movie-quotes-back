<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificationMail extends Mailable
{
	use Queueable, SerializesModels;

	public $route;

	public $name;

	public $subject;

	public $mainText;

	public $buttonText;

	public function __construct($route, $name, $subject, $mainText, $buttonText)
	{
		$this->route = $route;
		$this->name = $name;
		$this->subject = $subject;
		$this->mainText = $mainText;
		$this->buttonText = $buttonText;
	}

	public function build()
	{
		return $this->from('giorgitsukhishvili@redberry.ge', __('email.account-verification'))
		->subject($this->subject)
		->view('email.verification-email', ['name'=>$this->name, 'route' => $this->route, 'mainText' => $this->mainText, 'buttonText' => $this->buttonText]);
	}
}
