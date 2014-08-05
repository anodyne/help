<?php namespace Help\Foundation\Services;

class FlashNotifierService {

	protected $session;

	public function __construct(SessionStore $session)
	{
		$this->session = $session;
	}

	public function error($message)
	{
		$this->session->flash('flash.level', 'danger');
		$this->session->flash('flash.message', $message);
	}

	public function info($message)
	{
		$this->session->flash('flash.level', 'info');
		$this->session->flash('flash.message', $message);
	}

	public function success($message)
	{
		$this->session->flash('flash.level', 'success');
		$this->session->flash('flash.message', $message);
	}

	public function warning($message)
	{
		$this->session->flash('flash.level', 'warning');
		$this->session->flash('flash.message', $message);
	}

}