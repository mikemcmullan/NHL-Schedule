<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchesRenameDescriptionToTVInfoAddResults extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matches', function($table)
		{
			$table->renameColumn('description', 'tv_info')->nullable();
		});

		Schema::table('matches', function($table)
		{
			$table->string('results')->nullable()->after('tv_info');
		});

		DB::unprepared('ALTER TABLE ' . DB::getTablePrefix() . 'matches MODIFY tv_info varchar(255) DEFAULT NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matches', function($table)
		{
			$table->renameColumn('tv_info', 'description');
			$table->dropColumn('results');
		});

		DB::unprepared('ALTER TABLE ' . DB::getTablePrefix() . 'matches MODIFY description text NOT NULL');
	}

}
