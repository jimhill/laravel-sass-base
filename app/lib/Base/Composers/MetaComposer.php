<?php namespace Base\Composers;

use \Request;
use Config;

class MetaComposer {

    /**
     * Compose
     * 
     * @param  View $view
     * @return void
     */
    public function compose($view)
    {
        $meta = Config::get('meta');
        $meta['og_url'] = Request::url();
        $view->with('meta', $meta);
    }

}