<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('scores', function ($table)
		{
			$table->increments('id');
			$table->integer('match_id');
			$table->char('home_team', 3);
			$table->tinyInteger('home_score')->default(0);
			$table->tinyInteger('home_sog')->default(0);
			$table->char('away_team', 3);
			$table->tinyInteger('away_score')->default(0);
			$table->tinyInteger('away_sog')->default(0);
			$table->boolean('overtime')->default(false);
			$table->boolean('shootout')->default(false);
			$table->string('game_status', 10)->nullable();
			$table->string('game_time', 10)->nullable();
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
		Schema::drop('scores');
	}

}
