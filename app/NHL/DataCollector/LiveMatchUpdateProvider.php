<?php

namespace NHL\DataCollector;

use Carbon\Carbon;
use Illuminate\Config\Repository;

class LiveMatchUpdateProvider extends AbstractProvider {

	/**
	 * @var Repository
	 */
	private $config;

	/**
	 * @var Carbon
	 */
	private $date;

	/**
	 * @param Repository $config
	 * @param Carbon $date
	 */
	public function __construct(Repository $config, Carbon $date = null)
	{
		$this->config = $config;
		$this->date = $date;
	}

	/**
	 * @param Carbon $date
	 *
	 * @return $this
	 */
	public function setDate(Carbon $date)
	{
		$this->date = $date;

		return $this;
	}

	/**
	 * @return string
	 * @throws NonExistentTeamException
	 */
	public function getDownloadUrl()
	{
		return sprintf($this->config->get('nhl.jsonDayScoreboardUrl'), $this->date->toDateString());
	}

	/**
	 * @return Parsers\ScheduleParser
	 */
	public function getParser()
	{
		return new Parsers\LiveMatchUpdateParser;
	}
}