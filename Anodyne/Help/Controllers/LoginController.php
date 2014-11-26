<?php namespace Help\Controllers;

use Auth,
	View,
	Flash,
	Input,
	Session,
	Redirect,
	Validator,
	BaseController;

class LoginController extends BaseController {

	public function index()
	{
		return View::make('pages.login');
	}

	public function doLogin()
	{
		$validator = Validator::make(Input::all(), [
			'email'		=> 'required',
			'password'	=> 'required',
		], [
			'email.required' => "Email address is required.",
			'password.required' => "Passwords cannot be blank.",
		]);

		if ( ! $validator->passes())
		{
			// Set the flash message
			Flash::error("Please enter your email address and password and try again.");

			return Redirect::route('login')
				->withInput()
				->withErrors($validator->errors());
		}

		// Grab the values and trim them
		$email = trim(Input::get('email'));
		$password = trim(Input::get('password'));

		if (Auth::attempt(['email' => $email, 'password' => $password], true))
		{
			if (Session::has('url.intended'))
			{
				return Redirect::intended('home');
			}
			
			return Redirect::route('home');
		}

		// Set the flash message
		Flash::error("Either your email address or password were incorrect. Please try again.");

		return Redirect::route('login')->withInput();
	}

	public function logout()
	{
		Auth::logout();
		
		return Redirect::route('home');
	}

}