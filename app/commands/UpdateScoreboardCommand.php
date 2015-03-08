<?php

use Illuminate\Console\Command;
use NHL\DataCollector\LiveMatchUpdateProvider;
use NHL\Scoreboard\ScoreboardImporter;
use NHL\Storage\Match\MatchRepository;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateScoreboardCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:update-scoreboard';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update scoreboard for today.';

	/**
	 * @var MatchRepository
	 */
	private $matchRepo;

	/**
	 * @var LiveMatchUpdateProvider
	 */
	private $liveMatchUpdateProvider;

	/**
	 * Create a new command instance.
	 *
	 * @param MatchRepository $matchRepo
	 * @param LiveMatchUpdateProvider $liveMatchUpdateProvider
	 */
	public function __construct(MatchRepository $matchRepo, LiveMatchUpdateProvider $liveMatchUpdateProvider)
	{
		parent::__construct();
		$this->matchRepo = $matchRepo;
		$this->liveMatchUpdateProvider = $liveMatchUpdateProvider;
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
			$inProgress = $this->matchRepo->inProgress();

			if ( ! $inProgress->isEmpty())
			{
				$date = $inProgress->first()->date;

				$this->liveMatchUpdateProvider->setDate($date);
				$this->liveMatchUpdateProvider->addConsumer(
					App::make(NHL\DataCollector\Consumers\LiveMatchUpdateConsumer::class, ['date' => $date])
				);

				$this->liveMatchUpdateProvider->execute();

				$this->info('Scoreboard updated.');
			}
			else
			{
				$this->info('Scoreboard does not need to be updated.');
			}
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
