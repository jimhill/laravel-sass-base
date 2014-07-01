<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>{{{ $meta['title'] }}}</title>
<meta name="description" content="{{{ $meta['description'] }}}" />
<meta name="keywords" content="{{{ $meta['keywords'] }}}" />
<meta property="og:title" content="{{{ $meta['og_title'] }}}" />
<meta property="og:site_name" content="{{{ $meta['og_site_name'] }}}" />
<meta property="og:url" content="{{{ $meta['og_url'] }}}" />
<meta property="og:description" content="{{{ $meta['og_description'] }}}" />
<meta property="og:image" content="{{{ $meta['og_image'] }}}" />
<meta property="fb:app_id" content="{{{ $meta['fb_app_id'] }}}" />
<meta property="og:type" content="{{{ $meta['og_type'] }}}" />
<meta property="article:author" content="{{{ $meta['article_author'] }}}" />
<meta name="viewport" content="width=device-width, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="">
@if(App::environment() === 'production')
<link rel="stylesheet" href="//{{{ $cdn_path }}}/css/master.min.css" />
<link rel="shortcut icon" href="//{{{ $cdn_path }}}/img/favicon.png"> 
@else
<link rel="stylesheet" href="/css/main.css" />
<link rel="canonical" href="{{{ $meta['og_url'] }}}">
<link rel="shortcut icon" href="/img/favicon.png"> 
@endif
</head>
<body class="{{{ $body_class }}}">
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div class="">
        @yield('content')
    </div>

@if(App::environment() === 'production')
<script src="//{{{ $cdn_path }}}/js/plugins.min.js"></script>
<script src="//{{{ $cdn_path }}}/js/master.min.js"></script>
@else
<script src="/js/plugins.min.js"></script>
<script src="/js/main.js"></script>
@endif

@yield('javascript')

@if (App::environment() !== 'production')
<script>
    window.ga = function(){};
</script>
@endif
@if (App::environment() === 'production')
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', '{{{ Config::get("analytics.profiles.google.id") }}}', '{{{ Config::get("analytics.profiles.google.url") }}}');
ga('send', 'pageview');
</script>    
@endif
</body>
</html>
