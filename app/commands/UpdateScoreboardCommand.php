<?php

use Illuminate\Console\Command;
use NHL\Scoreboard\ScoreboardImporter;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateScoreboardCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:updateScoreboard';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update scoreboard for today.';

	/**
	 * @var ScoreboardImporter
	 */
	private $scoreboardImporter;

	/**
	 * Create a new command instance.
	 *
	 * @param ScoreboardImporter $scoreboardImporter
	 * @return \UpdateScoreboardCommand
	 */
	public function __construct(ScoreboardImporter $scoreboardImporter)
	{
		parent::__construct();
		$this->scoreboardImporter = $scoreboardImporter;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		try
		{
			$date = \Carbon\Carbon::now();

			if ($date->hour < 2)
			{
				$date = $date->subDay();
			}

			$this->scoreboardImporter->byDay($date);
			$this->info('Scoreboard updated.');
		}
		catch(Exception $e)
		{
			$this->error('Error updating scoreboard . ' . $e->getMessage());
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array();
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array();
	}

}
