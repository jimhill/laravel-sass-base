<?php namespace Base\Composers;

use Config;

class CdnComposer {

    /**
     * Compose
     * 
     * @param  View $view
     * @return void
     */
    public function compose($view)
    {    
    	$cdn_path = implode('/', array(
    		Config::get('cdn.cdn_domain'),
    		Config::get('cdn.cdn_path_prefix'),
    		Config::get('cdn.assets_version'),

    	)); 

    	dd($cdn_path);

        $view->with('cdn_path', $cdn_path);
    }

}