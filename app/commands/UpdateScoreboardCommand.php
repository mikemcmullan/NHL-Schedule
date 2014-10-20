<?php

use Illuminate\Console\Command;
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
	 * @var MatchRepository
	 */
	private $matchRepo;

	/**
	 * Create a new command instance.
	 *
	 * @param ScoreboardImporter $scoreboardImporter
	 * @param MatchRepository $matchRepo
	 * @return \UpdateScoreboardCommand
	 */
	public function __construct(ScoreboardImporter $scoreboardImporter, MatchRepository $matchRepo)
	{
		parent::__construct();
		$this->scoreboardImporter = $scoreboardImporter;
		$this->matchRepo = $matchRepo;
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
				$this->scoreboardImporter->byDay($inProgress->first()->date);
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
