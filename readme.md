## A quick personal setup for a laravel site with gulp and assets pipeline

This is a little quickstart for setting up Laravel sites with Gulp asset management (using Sass as the CSS preprocessor). Laravel is not included upstream.

### Step 1. Download and install vendors

`$ composer install`

### Step 2. Set your local environment

Edit `bootstrap/start.php`

Set your local environment e.g.

    $env = $app->detectEnvironment(array(

        'local' => array('your-machine.local'),

    ));
    
### Step 3. Install gulp locally

`$ npm i gulp`

### Step 4. Install gulp dependencies

`$ npm i -D gulp-util gulp-notify gulp-ruby-sass gulp-jshint gulp-concat gulp-uglify gulp-rename gulp-gzip gulp-awspublish`

### Step 5. Install "bourbon"

`$ gem install bourbon`

Then go into `app/assets/src/sass` and run:

`$ bourbon install`

### Step 6. Run main gulp task to watch your files

`$ gulp`

This will now listen for changes in the .scss files and compress them

---

## Gulp tasks

`$ gulp`

The default task will watch for changes in the .scss and .js files and process them

`$ gulp build`

This will run concatenation and minification on the CSS and JS files, gzip them and have them ready for export in the `app/assets/dist/version/` directory.

---

More to come soon...
