<?php

namespace NHL\DataCollector;

use Illuminate\Config\Repository;
use NHL\Exceptions\NonExistentTeamException;

class ScheduleProvider extends AbstractProvider {

	/**
	 * @var Repository
	 */
	private $config;

	/**
	 * @var
	 */
	private $team;

	/**
	 * @param Repository $config
	 * @param string $team
	 */
	public function __construct(Repository $config, $team = null)
	{
		$this->config = $config;
		$this->team = $team;
	}

	/**
	 * @param $team
	 *
	 * @return $this
	 */
	public function setTeam($team)
	{
		$this->team = $team;

		return $this;
	}

	/**
	 * @return string
	 * @throws NonExistentTeamException
	 */
	public function getDownloadUrl()
	{
		// Make sure the team exists.
		if ( ! $this->config->has("nhl.teams.{$this->team}"))
		{
			throw new NonExistentTeamException($this->team);
		}

		return sprintf($this->config->get('nhl.htmlTeamSeasonScheduleUrl'), $this->team);
	}

	/**
	 * @return Parsers\ScheduleParser
	 */
	public function getParser()
	{
		return new Parsers\ScheduleParser($this->config);
	}
}