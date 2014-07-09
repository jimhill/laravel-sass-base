<?php

class UserTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::create(array(
    		"username" => $_SERVER['USER_USERNAME'],
    		"first_name" => $_SERVER['USER_FIRST_NAME'],
    		"last_name" => $_SERVER['USER_LAST_NAME'],
    	    "password" => $_SERVER['USER_PASSWORD'],
        	"email"    => $_SERVER['USER_EMAIL'],
    	));
	}

}
