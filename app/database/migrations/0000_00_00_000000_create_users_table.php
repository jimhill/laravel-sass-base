<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments("id");
      		$table->string("username");
      		$table->string("first_name");
      		$table->string("last_name");
      		$table->string("password");
      		$table->string("email")->unique();
      		$table->string("remember_token")->nullable();
      		$table->timestamps();
      		$table->softDeletes();

      		// Indexes
      		$table->index('username');
      		$table->index('email');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists("user");
	}

}
