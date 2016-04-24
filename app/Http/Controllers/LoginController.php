<?php namespace Help\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Help\Http\Controllers\Controller;

class LoginController extends Controller {

	protected $auth;

	public function __construct(Guard $auth)
	{
		parent::__construct();

		$this->auth = $auth;
	}

	public function index()
	{
		return view('pages.login');
	}

	public function doLogin(Request $request)
	{
		$this->validate($request, [
			'email'		=> 'required',
			'password'	=> 'required',
		], [
			'email.required' => "Email address is required.",
			'password.required' => "Passwords cannot be blank.",
		]);

		if ($this->auth->attempt($request->only('email', 'password'), true))
		{
			return redirect()->intended(route('home'));
		}

		// Set the flash message
		flash_error("Either your email address or password were incorrect. Please try again.");

		return redirect()->route('login')->withInput();
	}

	public function logout()
	{
		$this->auth->logout();
		
		return redirect()->route('home');
	}

}
