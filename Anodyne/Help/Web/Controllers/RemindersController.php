<?php namespace Help\Controllers;

use View,
	Input,
	Password,
	Redirect;

class RemindersController extends BaseController {

	public function remind()
	{
		return View::make('password.remind');
	}

	public function doRemind()
	{
		switch ($response = Password::remind(Input::only('email')))
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
	}

	public function reset($token = null)
	{
		if (is_null($token)) \App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	public function doReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = \Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}