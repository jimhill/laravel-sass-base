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

Set your environments e.g.

    $env = $app->detectEnvironment(array(

        'local' => array('your-machine.local'),

    ));

### Step 4. Publish AWS config file

The aws-sdk-php-laravel package is only included in the local envirornment.

`$ php artisan config:publish aws/aws-sdk-php-laravel`

Now set your AWS configuration options in `app/config/packages/aws/aws-sdk-php-laravel/config.php`

### Step 5. Set up Rocketeer

`$ php artisan deploy:ignite`

This will create deployment configuration files in `app/config/packages/anahkiasen/rocketeer/`.

You can test your connection config with:

`$ php artisan deploy:check`

See the notes below: https://github.com/jimhill/laravel-sass-base#rocketeer
    
### Step 6. Install gulp locally

`$ npm i gulp`

### Step 7. Install gulp dependencies

`$ npm i -D gulp-util gulp-notify gulp-ruby-sass gulp-jshint gulp-concat gulp-uglify gulp-rename gulp-gzip`

### Step 8. Install "bourbon"

`$ gem install bourbon`

Then go into `app/assets/src/sass` and run:

`$ bourbon install`

### Step 9. Setting up your config

Take advantage of [Laravel's environment variable files](http://laravel.com/docs/configuration#protecting-sensitive-configuration) to protected your commited config files. 

An example template can be found in the root directory called `.env.local.php.tpl`. 

Simply rename this file to fit your environment, fill in whichever parameters you are going to use and then in the relevant config files e.g. `app/config/database.php` you can use `$_ENV['DB_HOST']` or `$_SERVER['DB_HOST']` (dependent on your machine).

### Step 10. Set up a user table and seed it

If you wish to get up and running using a user table and seed it with a master user, make sure you have filled out the relevant section in your environment config file in Step 9. Then run:

`php artisan migrate:refresh`

### Ready?

Go to your local domain in your browser...

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

## CDN Deployment

Firstly *build* your assets:

`$ gulp build`

Then use Artisan to push them to AWS S3 (remember we are using S3 configuration in the local environment only):

`$ php artisan cdn:deploy --env=local` 

---

More to come soon...

---

*Laravel is not included upstream*.
