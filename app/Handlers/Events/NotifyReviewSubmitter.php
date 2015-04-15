<?php namespace Help\Handlers\Events;

use Mail;
use Help\Events\ReviewWasUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class NotifyReviewSubmitter {

	public function __construct()
	{
		//
	}

	public function handle(ReviewWasUpdated $event)
	{
		$review = $event->getReview();

		if ($review->resolution !== null)
		{
			// Get the article
			$article = $review->article;

			$data = [
				'product'	=> $article->product->name,
				'article'	=> $article->title,
				'link'		=> route('article.show', [$article->product->slug, $article->slug]),
				'notes'		=> $review->notes,
				'resolution'=> $review->resolution,
			];

			Mail::queue('emails.article-review-complete', $data, function($msg) use ($review, $article)
			{
				$msg->to($review->submitter->email)
					->subject(config('anodyne.email.subject')." Article Review Request Completed")
					->replyTo($article->author->email);
			});
		}
	}

}
