<?php namespace Jep\Modules;

use Illuminate\Support\ServiceProvider;

class ModulesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('jep/modules');

		//Add install route
		$install = base_path() . '/workbench/jep/modules/src/install.php';
		if (file_exists($install)) {
       		require $install; 
        }

		//Add routes
	   $routes = base_path() . '/workbench/jep/modules/src/routes.php';
       
       if (file_exists($routes)) {
       		require $routes; 
       }

       //Add filters
       $filters = base_path() . '/workbench/jep/modules/src/filters.php';
       
       if (file_exists($filters)) {
       		require $filters; 
       }

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	
		
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}