<?php namespace Help\Mailers;

use HTML,
	Config,
	Comment,
	ItemRepositoryInterface,
	UserRepositoryInterface;

class ItemMailer extends BaseMailer {

	protected $items;
	protected $users;

	public function __construct(ItemRepositoryInterface $items,
			UserRepositoryInterface $users)
	{
		$this->items = $items;
		$this->users = $users;
	}

	public function addedComment(Comment $comment)
	{
		// Get the user it's coming from
		$user = $comment->user;

		// Get the item we're dealing with
		$item = $comment->item;

		$emailData = [
			'subject' => "Comment Added - ".$item->present()->name,
			'content' => $comment->present()->content,
			'from' => Config::get('xtras.email.general'),
			'replyTo' => $user->email,
			'to' => $item->user->email,
			'name' => HTML::link(route('item.show', [$item->user->username, $item->slug]), $item->present()->name),
			'type' => $item->present()->type,
			'userName' => $user->present()->name,
			'url' => route('item.show', [$item->user->username, $item->slug]),
		];

		return $this->send('comment', $emailData);
	}

	public function notifyForNewVersion($item)
	{
		// Get the people who want to be notified
		$users = $item->notifications;

		if ($users->count() > 0)
		{
			// Get the users' email addresses
			foreach ($users as $user)
			{
				$emails[$user->id] = $user->email;
			}

			// Make sure we only have the values
			$emailsArr = array_values($emails);

			$emailData = [
				'subject' => "Xtra Updated - ".$item->present()->name,
				'from' => Config::get('xtras.email.general'),
				'replyTo' => $user->present()->email,
				'bcc' => $emailsArr,
				'name' => HTML::link(route('item.show', [$item->user->username, $item->slug]), $item->present()->name),
				'type' => $item->present()->type,
				'history' => $item->metadata->present()->history,
				'version' => $item->present()->version,
				'url' => route('item.show', [$item->user->username, $item->slug]),
			];

			return $this->send('notify-update', $emailData);
		}
	}

	public function reportAbuse($data)
	{
		// Get the item
		$item = $this->items->find($data['item_id']);

		if ($item)
		{
			// Get the user it's coming from
			$user = $this->users->find($data['user_id']);

			$emailData = [
				'subject' => "[Abuse] Xtra Abuse Report - ".$item->present()->name,
				'content' => $data['content'],
				'from' => $user->present()->email,
				'replyTo' => $user->present()->email,
				'to' => Config::get('xtras.email.abuse'),
				'name' => HTML::link(route('item.show', [$item->user->username, $item->slug]), $item->present()->name),
				'type' => $item->present()->type,
				'userName' => $user->present()->name,
				'userEmail' => $user->present()->email,
				'url' => route('item.show', [$item->user->username, $item->slug]),
			];

			return $this->send('abuse', $emailData);
		}

		return false;
	}

	public function reportIssue($data)
	{
		// Get the item
		$item = $this->items->find($data['item_id']);

		if ($item)
		{
			// Get the user it's coming from
			$user = $this->users->find($data['user_id']);

			// Figure out where the email should go
			$to = ( ! empty($item->support) and filter_var($item->support, FILTER_VALIDATE_EMAIL))
				? $item->support
				: $item->user->email;

			$emailData = [
				'subject' => "Issue Reported - ".$item->present()->name,
				'content' => $data['content'],
				'from' => $user->present()->email,
				'replyTo' => $user->present()->email,
				'to' => $to,
				'name' => HTML::link(route('item.show', [$item->user->username, $item->slug]), $item->present()->name),
				'type' => $item->present()->type,
				'userName' => $user->present()->name,
				'userEmail' => $user->present()->email,
				'url' => route('item.show', [$item->user->username, $item->slug]),
			];

			return $this->send('issue', $emailData);
		}

		return false;
	}

	public function firstXtra($item)
	{
		$emailData = [
			'subject' => "Congratulations!",
			'from' => Config::get('xtras.email.general'),
			'replyTo' => Config::get('xtras.email.general'),
			'to' => $item->user->email,
			'url' => route('item.show', [$item->user->username, $item->slug]),
		];

		return $this->send('first-xtra', $emailData);
	}

}