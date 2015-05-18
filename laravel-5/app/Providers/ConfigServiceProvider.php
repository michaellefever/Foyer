<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider {

	/**
	 * Overwrite any vendor / package configuration.
	 *
	 * This service provider is intended to provide a convenient location for you
	 * to overwrite any "vendor" or package configuration that you may want to
	 * modify before the application handles the incoming request / command.
	 *
	 * @return void
	 */
	public function register()
	{
        config([
            'laravellocalization.supportedLocales' => [
                'nl' => array( 'name' => 'Nederlands', 'script' => 'Latn', 'native' => 'Nederlands' ),
                'fr'  => array( 'name' => 'français', 'script' => 'Latn', 'native' => 'français' ),
                'en'  => array( 'name' => 'English', 'script' => 'Latn', 'native' => 'English' )
            ],

            'laravellocalization.useAcceptLanguageHeader' => true,

            'laravellocalization.hideDefaultLocaleInURL' => false
        ]);
	}

}
