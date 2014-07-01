<?php namespace Base\Composers;

use \Route;
use \Str;

class BodyClassComposer {

    public function compose($view)
    {
    	$route_array = Str::parseCallback(Route::currentRouteAction(), null);

    	if (last($route_array) != null) {
    	
    		$controller = str_replace('Controller', '', class_basename(head($route_array)));

    		$action = str_replace(array('view', 'get', 'post', 'patch', 'put', 'delete'), '', last($route_array));
    	}
        
        $view->with('body_class', strtolower($controller . ' ' . $controller . '-' . $action) );
    }

}