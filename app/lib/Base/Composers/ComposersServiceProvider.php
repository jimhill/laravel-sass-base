<?php namespace Base\Composers;

use Illuminate\Support\ServiceProvider;

class ComposersServiceProvider extends ServiceProvider {
	
	public function register()
	{
	}

	public function boot()
	{
		$this->app->view->composers(array(
    		'Base\Composers\BodyClassComposer' => array('layout.master'),
    		'Base\Composers\MetaComposer' => array('layout.master'),
    		'Base\Composers\CdnComposer' => array('layout.master'),
		));
	}

}