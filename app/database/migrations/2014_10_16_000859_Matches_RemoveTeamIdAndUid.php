<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MatchesRemoveTeamIdAndUid extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matches', function($table)
		{
			$table->dropColumn('team_id');
			$table->dropColumn('uid');
		});
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
			$table->char('uid', 32)->after('id');
			$table->char('team_id', 3)->after('uid');
		});
	}

}
