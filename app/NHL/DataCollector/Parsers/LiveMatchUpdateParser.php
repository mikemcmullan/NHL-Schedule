<?php

namespace NHL\DataCollector\Parsers;

use Illuminate\Support\Collection;
use NHL\DataCollector\Contracts\Parser;

class LiveMatchUpdateParser implements Parser {

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function parse($data)
	{
		$json = $this->removePadding($data);

		$data = array_get(json_decode($json, true), 'games');

		return new Collection(array_map([$this, 'mapMatches'], $data));
	}

	private function mapMatches($match)
	{
		$bs = array_get($match, 'bs');
		$overtime = stripos($bs, 'OT') === false ? false : true;
		$shootout = stripos($bs, 'SO') === false ? false : true;

		return new \Score([
			'home_team'     => array_get($match, 'hta'),
			'home_score'    => (int) array_get($match, 'hts'),
			'home_sog'      => (int) array_get($match, 'htsog'),
			'away_team'     => array_get($match, 'ata'),
			'away_score'    => (int) array_get($match, 'ats'),
			'away_sog'      => (int) array_get($match, 'atsog'),
			'overtime'      => $overtime,
			'shootout'      => $shootout,
			'game_status'   => array_get($match, 'bsc'),
			'game_time'     => $bs,
		]);
	}

	/**
	 * @param $jsonp
	 * @return mixed
	 */
	private function removePadding($jsonp)
	{
		return preg_replace('/\w+\((.*)\)/', '$1', $jsonp);
	}
}