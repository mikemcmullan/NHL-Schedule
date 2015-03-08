<?php

namespace NHL\DataCollector\Consumers;

use Illuminate\Support\Collection;
use NHL\DataCollector\Contracts\Consumer;
use NHL\Storage\Match\MatchRepository;

class ScheduleDatabaseConsumer implements Consumer {

	/**
	 * @var MatchRepository
	 */
	private $matchRepo;

	/**
	 * @var string
	 */
	private $team;

	/**
	 * @param MatchRepository $matchRepo
	 * @param string $team
	 */
	public function __construct(MatchRepository $matchRepo, $team = null)
	{
		$this->matchRepo = $matchRepo;
		$this->team = $team;
	}

	/**
	 * @param $team
	 */
	public function setTeam($team)
	{
		$this->team = $team;
	}

	/**
	 * @param Collection $data
	 *
	 * @return mixed|void
	 */
	public function execute(Collection $data)
	{
		foreach ($data as $match)
		{
			$this->insert($match);
		}
	}

	/**
	 * @param $match
	 *
	 * @return mixed
	 */
	private function insert($match)
	{
		$m = [
			'date'          => $match['date'],
			'home_team'     => $match['home_team'],
			'away_team'     => $match['away_team']
		];

		$match['tv_info'] && $m['tv_info'] = $match['tv_info'];
		$match['results'] && $m['results'] = $match['results'];

		if ($match = $this->matchRepo->get($this->team, $match['date'])->first())
		{
			return $match->update($m);
		}
		else
		{
			return $this->matchRepo->create($m);
		}
	}

}