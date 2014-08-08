<?php namespace Help\Controllers;

use Auth,
	View,
	Event,
	Input,
	Session,
	Redirect,
	Validator,
	ArticleRepositoryInterface;

class MainController extends BaseController {

	protected $articles;

	public function __construct(ArticleRepositoryInterface $articles)
	{
		$this->articles = $articles;
	}

	public function index()
	{
		return View::make('pages.home')
			->withLatest($this->articles->getLatest(10))
			->withHelpful($this->articles->getPopular(10));
	}

	public function login()
	{
		return View::make('pages.login');
	}

	public function doLogin()
	{
		// Validate
		$validator = Validator::make(Input::all(), [
			'email'		=> 'required',
			'password'	=> 'required',
		], [
			'email.required' => "Email address is required.",
			'password.required' => "Passwords cannot be blank.",
		]);

		if ( ! $validator->passes())
		{
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

		Flash::error("Either your email address or password were incorrect. Please try again.");

		return Redirect::route('login')
			->withInput();
	}

	public function logout()
	{
		Auth::logout();

		return Redirect::route('home');
	}

	public function register()
	{
		// Generate a random number
		$random = mt_rand(1, 999);

		// Put the number into the session
		Session::flash('confirmNumber', $random);

		return View::make('pages.register')->with('confirmNumber', $random);
	}

	public function doRegistration()
	{
		// Setup the validator
		$validator = Validator::make(Input::all(), [
			'name'				=> 'required',
			'email'				=> 'required|email|unique:users,email',
			'password'			=> 'required',
			'password_confirm'	=> 'required|same:password',
			'confirm'			=> 'required'
		], [
			'email.unique'		=> "The email address you entered is already registered. You can <a href='".\URL::route('home')."'>log in</a>, or, if you've forgotten your password, you can reset it from the <a href='".\URL::to('password/remind')."'>Reset Password</a> page.",
		]);

		// Validator failed
		if ( ! $validator->passes())
		{
			Flash::error("Your information couldn't be validated. Please correct the issue(s) and try again.");

			return Redirect::route('register')
				->withInput()
				->withErrors($validator->errors());
		}

		// Make sure the confirmation number matches
		if (Input::get('confirm') != Session::get('confirmNumber'))
		{
			Flash::error("Registration failed due to incorrect anti-spam confirmation number. Please try again.");

			return Redirect::route('register');
		}

		// Create the user
		$user = $this->users->create(Input::all(), false);

		if ($user)
		{
			// Log the user in
			Auth::login($user, true);

			// Fire the registration event
			Event::fire('user.registered', [$user, Input::all()]);

			Flash::success("Welcome to AnodyneXtras!");

			return Redirect::route('home');
		}
		else
		{
			Flash::error("There was an error creating your account. Please try again.");

			return Redirect::route('register')->withInput();
		}
	}

}
