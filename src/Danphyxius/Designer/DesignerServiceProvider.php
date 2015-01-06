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
			return $app->make('DanPhyxius\Designer\Console\DesignerGenerateCommand');
		});

		$this->commands('designer.command.make');
	}

}
