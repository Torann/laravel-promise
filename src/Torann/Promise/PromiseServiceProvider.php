<?php namespace Torann\Promise;

use Illuminate\Support\ServiceProvider;

class PromiseServiceProvider extends ServiceProvider {

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
		$this->package('torann/promise');
	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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