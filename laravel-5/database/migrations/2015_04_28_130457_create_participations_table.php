<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('participations', function(Blueprint $table)
        {
            $table->integer('idW')
                ->foreign('idW')->references('idW')->on('races');
            $table->integer('year');
            $table->integer('raceP')->unsigned()
                ->foreign('raceP')->references('id')->on('users');
            $table->integer('raceNumber');
            $table->unique('raceNumber');
            $table->integer('chipNumber')->nullable();
            $table->dateTime('time');
            $table->boolean('paid');
            $table->boolean('wiredTransfer');
            $table->boolean('signedUpOnline');
            $table->timestamps();

            $table->primary(array('year', 'idW', 'raceP'));
        });
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('participations');
	}

}
