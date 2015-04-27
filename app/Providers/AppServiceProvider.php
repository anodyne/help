<?php namespace Help\Providers;

use Help\Services\FlashNotifier,
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
		$this->setRepositoryBindings();

		if ($this->app->isDownForMaintenance())
		{
			view()->share('_icons', config('icons'));
		}
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
		// Grab the aliases from the config
		$this->aliases = $this->app['config']['app.aliases'];

		if ($this->app['env'] == 'local')
		{
			if (class_exists('Barryvdh\Debugbar\ServiceProvider'))
			{
				$this->app->register('Barryvdh\Debugbar\ServiceProvider');
			}
		}

		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'Help\Services\Registrar'
		);

		$this->app->bind('markdown', function($app)
		{
			return new MarkdownParser(new CommonMarkConverter);
		});

		$this->app->bind('flash', function($app)
		{
			return new FlashNotifier($app['session.store']);
		});
	}

	protected function setRepositoryBindings()
	{
		// Build a list of repositories that should be built
		$bindings = ['Article', 'Product', 'Rating', 'Review', 'Tag'];

		// Loop through the repositories and do the binding
		foreach ($bindings as $binding)
		{
			$this->bindRepository($binding);
		}
	}

	private function bindRepository($item)
	{
		// Set the concrete and abstract names
		$abstract = "{$item}RepositoryInterface";
		$concrete = "{$item}Repository";

		// Bind to the container
		$this->app->bind(
			[$abstract => $this->aliases[$abstract]],
			$this->aliases[$concrete]
		);
	}

}
