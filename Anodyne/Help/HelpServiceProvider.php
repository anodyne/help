<?php namespace Help;

use App,
	Auth,
	View,
	Event,
	Config;
use Ikimea\Browser\Browser;
use Illuminate\Support\ServiceProvider;

class HelpServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->registerBrowser();
		$this->registerMarkdown();
		$this->registerEvents();
		$this->registerFlashNotifier();
	}

	public function boot()
	{
		$this->checkBrowser();
		$this->setupBindings();
	}

	protected function checkBrowser()
	{
		$this->app->before(function($request)
		{
			// Get the browser object
			$browser = App::make('browser');

			$supported = array(
				Browser::BROWSER_IE			=> 9,
				Browser::BROWSER_CHROME		=> 26,
				Browser::BROWSER_FIREFOX	=> 20,
			);

			if (array_key_exists($browser->getBrowser(), $supported) 
					and $browser->getVersion() < $supported[$browser->getBrowser()])
			{
				header("Location: browser.php");
				die();
			}
		});
	}

	protected function setupBindings()
	{
		// Get the class aliases
		$a = Config::get('app.aliases');

		// Set up bindings from the interface to their concrete classes
		App::bind($a['ArticleRepositoryInterface'], $a['ArticleRepository']);
		App::bind($a['ProductRepositoryInterface'], $a['ProductRepository']);
		App::bind($a['TagRepositoryInterface'], $a['TagRepository']);

		// Make sure we some variables available on all views
		View::share('_currentUser', Auth::user());
		View::share('_icons', Config::get('icons'));
	}

	protected function registerBrowser()
	{
		$this->app['browser'] = $this->app->share(function($app)
		{
			return new Browser;
		});
	}

	protected function registerMarkdown()
	{
		$this->app['markdown'] = $this->app->share(function($app)
		{
			return new \Help\Services\MarkdownService(new \Parsedown);
		});
	}

	protected function registerEvents()
	{
		//
	}

	protected function registerFlashNotifier()
	{
		$this->app['flash'] = $this->app->share(function($app)
		{
			return new \Help\Services\FlashNotiferService($app['session.store']);
		});
	}

}