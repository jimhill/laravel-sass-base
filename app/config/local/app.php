<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Providers
	|--------------------------------------------------------------------------
	|
	| These are appended to the main app.php providers
	|
	*/
	'providers' => append_config(array(
		'Aws\Laravel\AwsServiceProvider',
		'Base\Composers\ComposersServiceProvider',
		'Base\DeployServiceProvider',
	)),

	/*
	|--------------------------------------------------------------------------
	| Aliases
	|--------------------------------------------------------------------------
	|
	| These are appended to the main app.php aliases
	|
	*/
	'aliases' => append_config(array(
		'AWS' => 'Aws\Laravel\AwsFacade',
	)),

);