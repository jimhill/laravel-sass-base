<?php namespace Base\Repositories;

use Illuminate\Support\ServiceProvider;
use App;

class RepositoriesServiceProvider extends ServiceProvider {
	
	/**
	 * Register the repositories.
	 *
	 * @return void
	 */
	public function register()
	{
		App::bind('Base\Repositories\ExampleRepositoryInterface', 'Base\Repositories\DbExampleRepository');
	}

}