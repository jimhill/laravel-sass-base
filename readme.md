## Jim Hill's quick start

This is a little helper quickstart for setting up Laravel sites with Gulp asset management

### Step 1. Download and install vendors

`$ composer install`

### Step 2. Install gulp dependencies

`$ npm i -D gulp-util gulp-notify gulp-ruby-sass gulp-jshint gulp-concat gulp-uglify gulp-rename gulp-gzip gulp-awspublish`

### Step 3. Install "bourbon"

`$ gem install bourbon`

Then go into `app/assets/src/sass` and run:

`$ bourbon install`

### Step 4. Run main gulp task

`$ gulp`

This will now listen for changes in the .scss files and compress them