<?php

namespace NHL\Common;

use Illuminate\Config\Repository as ConfigRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class ScheduleSorter {

	/**
	 * @var sortedSchedule
	 */
	private $sortedSchedule = [];

	/**
	 * @var nextGame
	 */
	private $nextGame = false;

	/**
	 * @var ConfigRepository
	 */
	private $config;

	/**
	 * @param ConfigRepository $config
	 */
	public function __construct(ConfigRepository $config)
	{
		$this->config = $config;
		$this->sortedSchedule = new Collection();
	}

	/**
	 * @param $match
	 * @return bool
	 */
	private function determineIfNextGame($match)
	{
		return $match['date']->addHours(2)->addMinutes(30) > $this->config->get('nhl.currentDateTime') && $this->nextGame === false;
	}

	/**
	 * @param  array $match
	 * @return void
	 */
	private function divideIntoMonths($match)
	{
		if ($this->determineIfNextGame($match))
		{
			$this->nextGame = true;
			$match['nextGame'] = true;
		}

		$month = $match['date']->format('F');

		if ( ! $this->sortedSchedule->has($month))
		{
			$this->sortedSchedule->put($month, new Collection());
		}

		$this->sortedSchedule->get($month)->push($match);
	}

	/**
	 * @param  array $a
	 * @param  array $b
	 * @return boolean
	 */
	private function sortScheduleByMonth($a, $b)
	{
		$matchA = $a->first()['date'];
		$matchB = $b->first()['date'];

		$dateA = Carbon::create($matchA->year, $matchA->month, $matchA->daysInMonth);
		$dateB = Carbon::create($matchB->year, $matchB->month, $matchB->daysInMonth);

		return $dateA > $dateB;
	}

	/**
	 * Sort the schedule.
	 *
	 * @param Collection $schedule
	 * @return array
	 */
	public function sort(Collection $schedule)
	{
		$schedule->each(function($match) { return $this->divideIntoMonths($match); });

		$this->sortedSchedule->sort(function($a, $b) { return $this->sortScheduleByMonth($a, $b); });

		return $this->sortedSchedule;
	}
}