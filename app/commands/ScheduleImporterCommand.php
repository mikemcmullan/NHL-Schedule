<?php

use Illuminate\Console\Command;
use NHL\Exceptions\NonExistentTeamException;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use NHL\Schedule\ScheduleImporter;

class ScheduleImporterCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:importSchedule';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import a teams schedule.';

    /**
     * @var \NHL\Schedule\ScheduleImporter
     */
    private $scheduleImporter;

	/**
	 * Create a new command instance.
	 *
	 * @param ScheduleImporter $scheduleImporter
	 * @return \ScheduleImporterCommand
	 */
	public function __construct(ScheduleImporter $scheduleImporter)
	{
		parent::__construct();
        $this->scheduleImporter = $scheduleImporter;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$teamID = $this->argument('teamID');

        try
        {
            $this->scheduleImporter->run($teamID);
        }
        catch(NonExistentTeamException $e)
        {
            $this->error('Invalid Team ID');
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('teamID', InputArgument::REQUIRED, 'TOR'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
//			array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
