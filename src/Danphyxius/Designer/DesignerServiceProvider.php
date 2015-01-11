<?php namespace Danphyxius\Designer;

use Illuminate\Support\ServiceProvider;

class DesignerServiceProvider extends ServiceProvider {

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
		$this->package('danphyxius/designer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerArtisanCommand();
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('designer');
	}

	/**
	 * Register the Artisan command.
	 *
	 * @return void
	 */
	public function registerArtisanCommand()
	{
		$this->app->bindShared('designer.command.make', function($app)
		{
			return $app->make('Danphyxius\Designer\Commands\GenerateCommand');
		});

		$this->commands('designer.command.make');
	}


}
