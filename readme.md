## A quick personal setup for a laravel site with gulp and assets pipeline

This is a little quickstart for setting up Laravel sites with Gulp asset management (using Sass as the CSS preprocessor).

Check out these sites for individual package documentation:

* http://laravel.com/
* http://gulpjs.com/
* http://sass-lang.com/
* http://rocketeer.autopergamene.eu/
* https://github.com/aws/aws-sdk-php-laravel

### Step 1. Initiate

Set up a local environment however you prefer e.g. using Vagrant, MAMP, local web server etc.

### Step 2. Download and install vendors

`$ cd` into your project's development directory

`$ composer install`

### Step 3. Set your local environment

Edit `bootstrap/start.php`

Set your local environment e.g.

    $env = $app->detectEnvironment(array(

        'local' => array('your-machine.local'),

    ));

### Step 4. Publish AWS config file

`$ php artisan config:publish aws/aws-sdk-php-laravel`

Now set your AWS configuration options in `app/config/packages/aws/aws-sdk-php-laravel/config.php`
    
### Step 5. Install gulp locally

`$ npm i gulp`

### Step 6. Install gulp dependencies

`$ npm i -D gulp-util gulp-notify gulp-ruby-sass gulp-jshint gulp-concat gulp-uglify gulp-rename gulp-gzip`

### Step 7. Install "bourbon"

`$ gem install bourbon`

Then go into `app/assets/src/sass` and run:

`$ bourbon install`

Go to your local domain in your browser...

### Step 8. Set up Rocketeer

`$ php artisan deploy:ignite`

This will create deployment configuration files in `app/config/packages/anahkiasen/rocketeer/`.

You can test your connection config with:

`$ php artisan deploy:check`

---

## Gulp tasks

`$ gulp`

The default task will watch for changes in the .scss and .js files and process them

`$ gulp build`

This will run concatenation and minification on the CSS and JS files, gzip them and have them ready for export in the `app/assets/dist/version/` directory.

---

## Rocketeer

If you are having permission problems with Rocketeer you can use `acl` on your server. Take a look at https://github.com/Anahkiasen/rocketeer/pull/85 for some tips. 

Also If you have separate environment config directories for your laravel application add them to `app/config/packages/anahkiasen/rocketeer/remote.php` e.g.:

    'shared' => array(
		'app/config/staging',
		'{path.storage}/logs',
		'{path.storage}/sessions',
	),

---

More to come soon...

*Laravel is not included upstream*.
