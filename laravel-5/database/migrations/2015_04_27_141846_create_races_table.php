<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('races', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('nameOfTheRace');
            $table->string('firstRaceNumber');
            $table->integer('distance')->unsigned();
            $table->dateTime('startTime')->nullable();
            $table->string('status')->nullable();
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
		Schema::drop('races');
	}

}
