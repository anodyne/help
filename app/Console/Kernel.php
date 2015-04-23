<?php namespace Help\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'Help\Console\Commands\Inspire',
		'Help\Console\Commands\ClearViews',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		// Clear the application cache once a day
		$schedule->command('cache:clear')->daily();

		// Clear the views cache once a day
		$schedule->command('views:clear')->daily();
	}

}
