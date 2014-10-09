<?php

use Illuminate\Console\Command;
use NHL\Schedule\ScheduleImporter;
use NHL\Storage\Match\MatchRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateTodaysSchedule extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:updateTodaysSchedule';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the schedule for teams playing today.';

	/**
	 * @var ScheduleImporter
	 */
	private $scheduleImporter;

	/**
	 * @var MatchRepository
	 */
	private $match;

	/**
	 * Create a new command instance.
	 *
	 * @param ScheduleImporter $scheduleImporter
	 * @param MatchRepository $match
	 * @return \UpdateTodaysSchedule
	 */
	public function __construct(ScheduleImporter $scheduleImporter, MatchRepository $match)
	{
		parent::__construct();
		$this->scheduleImporter = $scheduleImporter;
		$this->match = $match;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$todayMatches = $this->match->today();

		if ( ! $todayMatches->isEmpty())
		{
			$todayMatches->each(function($item)
			{
				$this->scheduleImporter->bySeason($item->team_id);
				$this->info($item->team_id . ' Schedule has been updated.');
			});
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
