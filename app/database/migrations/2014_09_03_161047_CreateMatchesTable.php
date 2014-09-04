<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatchesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function($table)
        {
            $table->increments('id');
            $table->char('uid', 32);
            $table->char('team_id', 3);
            $table->dateTime('date')->default('0000-00-00 00:00:00');
            $table->char('home_team', 3);
            $table->char('away_team', 3);
            $table->text('description');
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
		Schema::drop('matches');
	}

}
