<?php

namespace NHL\DataCollector\Consumers;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use NHL\DataCollector\Contracts\Consumer;
use NHL\Storage\Match\MatchRepository;
use NHL\Storage\Score\ScoreRepository;

class LiveMatchUpdateConsumer implements Consumer {

	/**
	 * @var MatchRepository
	 */
	private $matchRepo;

	/**
	 * @var Carbon
	 */
	private $date;

	/**
	 * @var ScoreRepository
	 */
	private $scoreRepo;

	/**
	 * @param MatchRepository $matchRepo
	 * @param ScoreRepository $scoreRepo
	 * @param Carbon $date
	 */
	public function __construct(MatchRepository $matchRepo, ScoreRepository $scoreRepo, Carbon $date = null)
	{
		$this->matchRepo = $matchRepo;
		$this->scoreRepo = $scoreRepo;
		$this->date = $date;
	}

	/**
	 * @param Carbon $date
	 */
	public function setDate(Carbon $date)
	{
		$this->date = $date;
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
	 * @return bool
	 */
	private function insert($match)
	{
		$matchOwner = $this->matchRepo->get([$match['home_team'], $match['away_team']], $this->date)->first();

		if ( ! $matchOwner || ! in_array($match['game_status'], ['final', 'progress', 'critical']))
		{
			return false;
		}

		if ( ! $matchOwner->scores)
		{
			$this->scoreRepo->saveScoreToMatch($matchOwner->id, [$match]);
		}
		else
		{
			$this->scoreRepo->updateMatchScore($matchOwner->id, [$match]);
		}
	}

}