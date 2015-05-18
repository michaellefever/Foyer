<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('registrants', function(Blueprint $table)
		{
			$table->increments('id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->rememberToken();
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('isAdmin');
            $table->string('password', 64);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('registrants');
	}

}
