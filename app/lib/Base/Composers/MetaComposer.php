<?php namespace Base\Composers;

use \Request;

class MetaComposer {

    /**
     * Compose
     * 
     * @param  View $view
     * @return void
     */
    public function compose($view)
    {
        $meta = array(
            'title' => 'Hello Jim Blog',
            'description' => 'This is the personal blog of Jim Hill, a British web designer and developer. Expect some rants and ramblings.',
            'keywords' => 'blog,web design blog, uk web designer blog, uk tech blog, uk tech and startups, designer , developer',
            'og_title' => 'Hello Jim Blog',
            'og_site_name' => 'Hello Jim',
            'og_url' => Request::url(),
            'og_description' => 'This is the personal blog of Jim Hill, a British web designer and developer. Expect some rants and ramblings.',
            'og_image' => '',
            'fb_app_id' => '781249111915918',
            'og_type' => 'website',
            'article_author' => 'jimhillx'
        );
        
        $view->with('meta', $meta);
    }

}