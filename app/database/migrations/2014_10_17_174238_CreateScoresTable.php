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
			$table->char('team_id', 3);
			$table->tinyInteger('score')->default(0);
			$table->boolean('overtime')->default(false);
			$table->boolean('shootout')->default(false);
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
