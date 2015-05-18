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
            $table->integer('race_id')->unsigned()->index();
            $table->foreign('race_id')->references('id')->on('races')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->integer('year');

            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->integer('raceNumber');
            //$table->unique('raceNumber');
            $table->integer('chipNumber')->nullable();
            $table->dateTime('time')->nullable();
            $table->boolean('paid');
            $table->boolean('wiredTransfer');
            $table->boolean('signedUpOnline');
            $table->timestamps();

            $table->primary(array('user_id', 'race_id', 'year'));

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
