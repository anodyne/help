<?php namespace Help\Providers;

use Ikimea\Browser\Browser;
use Help\Services\Sanitizer,
	Help\Services\FlashNotifier,
	Help\Services\MarkdownParser;
use Illuminate\Support\ServiceProvider;
use League\CommonMark\CommonMarkConverter;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('browser', function($app)
		{
			return new Browser;
		});

		$this->app->bind('markdown', function($app)
		{
			return new MarkdownParser(new CommonMarkConverter);
		});

		$this->app->bind('flash', function($app)
		{
			return new FlashNotifier($app['session.store']);
		});

		$this->app->bind('sanitizer', function($app)
		{
			return new Sanitizer;
		});

		$this->setRepositoryBindings();
	}

	protected function setRepositoryBindings()
	{
		// Build a list of repositories that should be built
		$bindings = ['Article', 'Product', 'Tag'];

		// Loop through the repositories and do the binding
		foreach ($bindings as $binding)
		{
			$this->bindRepository($binding);
		}
	}

	private function bindRepository($item)
	{
		// Grab the aliases from the config
		$aliases = $this->app['config']['app.aliases'];

		// Set the concrete and abstract names
		$abstract = "{$item}RepositoryInterface";
		$concrete = "{$item}Repository";

		// Bind to the container
		$this->app->bind([$abstract => $aliases[$abstract]], $aliases[$concrete]);
	}

}
