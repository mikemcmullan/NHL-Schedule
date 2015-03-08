<?php

use Illuminate\Console\Command;
use NHL\Standings\Importer;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class StandingsImporterCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'nhl:importStandings';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import league standings.';

    /**
     * @var \NHL\Standings\Importer
     */
    private $importer;

	/**
	 * Create a new command instance.
	 *
	 * @param Importer $importer
	 */
	public function __construct(Importer $importer)
	{
		parent::__construct();
        $this->importer = $importer;
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$type = $this->argument('type');

        try
        {
            var_dump($this->importer->all($type));
        }
        catch(NonExistentTeamException $e)
        {
            $this->error($e->getMessage());
        }
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [
			['type', InputArgument::REQUIRED]
		];
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
