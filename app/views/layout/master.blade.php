<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>@yield('title')</title>
<meta name="description" content="" />
<meta name="viewport" content="width=device-width, user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="apple-mobile-web-app-title" content="">
@if(App::environment() === 'production')
<link rel="stylesheet" href="{{{ Config::get('assets.cdn_base') }}}/{{{ Config::get('assets.asset_version') }}}/css/master.min.css" />
@else
<link rel="stylesheet" href="/css/main.css" />
@endif
</head>
<body>
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div class="">
        @yield('content')
    </div>

@if(App::environment() === 'production')
<script src="{{{ Config::get('assets.cdn_base') }}}/{{{ Config::get('assets.asset_version') }}}/js/plugins.min.js"></script>
<script src="{{{ Config::get('assets.cdn_base') }}}/{{{ Config::get('assets.asset_version') }}}/js/master.min.js"></script>
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

ga('create', '{{{ Config::get("analytics.google.id") }}}', '{{{ Config::get("analytics.google.url") }}}');
ga('send', 'pageview');
</script>    
@endif
</body>
</html>
