<?php namespace Help\Commands;

use User;
use Help\Commands\Command;
use Illuminate\Contracts\Mail\MailQueue,
	Illuminate\Contracts\Bus\SelfHandling;

class ShareArticleCommand extends Command implements SelfHandling {

	protected $recipients;
	protected $message;
	protected $user;

	public function __construct($recipients, $message, User $user)
	{
		$this->recipients = $recipients;
		$this->message = $message;
		$this->user = $user;
	}

	public function handle(MailQueue $mailer)
	{
		// Build the data array
		$data = [
			'content' => $this->message,
		];

		// Break the recipients into an array
		$recipients = explode(';', $this->recipients);

		// Grab the user
		$user = $this->user;

		// Send the email
		$mailer->queue('emails.article-share', $data, function($msg) use ($recipients, $user)
		{
			$msg->to($recipients)
				->subject(config('anodyne.email.subject')." Someone Has Shared an Article With You!")
				->from(config('anodyne.email.address'), config('anodyne.email.name'))
				->replyTo($user->email);
		});
	}

}
