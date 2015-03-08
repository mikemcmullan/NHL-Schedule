<?php

use Illuminate\Console\Command;
use NHL\DataCollector\ScheduleProvider;
use NHL\DataCollector\Consumers\ScheduleDatabaseConsumer;
use NHL\Storage\Match\MatchRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateTodaysScheduleCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:update-todays-schedule';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update the schedule for teams playing today.';

	/**
	 * @var MatchRepository
	 */
	private $matchRepo;

	/**
	 * @var ScheduleProvider
	 */
	private $scheduleProvider;

	/**
	 * Create a new command instance.
	 *
	 * @param MatchRepository $matchRepo
	 */
	public function __construct(MatchRepository $matchRepo)
	{
		parent::__construct();
		$this->matchRepo = $matchRepo;
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$todayMatches = $this->matchRepo->today();

		if ( ! $todayMatches->isEmpty())
		{
			$todayMatches->each(function($item)
			{
				$this->scheduleProvider = App::make(ScheduleProvider::class);
				$this->scheduleProvider->setTeam($item['home_team']);
				$this->scheduleProvider->addConsumer(
					App::make(ScheduleDatabaseConsumer::class, ['team' => $item['home_team']])
				);
				$this->scheduleProvider->execute();

				$this->info($item->home_team . ' / ' . $item->away_team . ' Schedule has been updated.');
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
