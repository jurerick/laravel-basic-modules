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
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
	
		
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
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('modules');
	}

}