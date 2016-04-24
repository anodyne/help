<?php namespace Help\Handlers\Events;

use Mail;
use Help\Events\ReviewWasCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NotifyReviewCreated {

	public function __construct()
	{
		//
	}

	public function handle(ReviewWasCreated $event)
	{
		$review = $event->getReview();

		// Get the article
		$article = $review->article;

		$data = [
			'user'		=> $review->submitter->name,
			'product'	=> $article->product->name,
			'article'	=> $article->title,
			'link'		=> route('article.show', [$article->product->slug, $article->slug]),
			'comments'	=> $review->comments,
			'type'		=> $review->type,
		];

		Mail::queue('emails.article-review-created', $data, function($msg) use ($review, $article)
		{
			$msg->to(config('anodyne.email.address'))
				->subject(config('anodyne.email.subject')." Article Review Request Submitted")
				->from($review->submitter->email, $review->submitter->name)
				->replyTo($review->submitter->email);
		});
	}

}
