<?php

namespace NHL\DataCollector\Parsers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use NHL\DataCollector\Contracts\Parser;
use Sunra\PhpSimple\HtmlDomParser;

class ScheduleParser implements Parser {

	/**
	 * Parse the data.
	 *
	 * @param $data
	 *
	 * @return Collection
	 */
	public function parse($data)
	{
		// Find the schedule table.
		$matchesTable = HtmlDomParser::str_get_html($data)->find('.schedTbl tbody tr');

		// Remove the table header.
		array_shift($matchesTable);

		// Map through the table rows and extract match data.
		$matches = new Collection(array_filter(array_map([$this, 'mapMatches'], $matchesTable)));

		// Sort the matches by their date.
		return $matches->sortBy(function($value)
		{
			return $value['date'];
		});
	}

	/**
	 * Return desired keys & values based on provided data.
	 *
	 * @param  \simple_html_dom_node $match
	 * @return array
	 */
	private function mapMatches(\simple_html_dom_node $match)
	{
		if (count($match->find('td')) < 6)
		{
			return;
		}

		$date = head($match->find('.date .skedStartDateSite'))->innertext;
		$time = head($match->find('.time .skedStartTimeEST'))->innertext;
		$time = str_replace(' ET', '', $time);

		$info = stripHTMLComments(head($match->find('.tvInfo'))->innertext);

		$tvInfo = $this->getTvInfo($info);
		$results = $this->getResults($info);

		$teams = [
			'home' => getTeamID(trim(array_get($match->find('.team .teamName'), 1)->plaintext)),
			'away' => getTeamID(trim(array_get($match->find('.team .teamName'), 0)->plaintext))
		];

		return new \Match([
			'date'        => $this->createDate($date, $time),
			'home_team'   => $teams['home'],
			'away_team'   => $teams['away'],
			'tv_info'     => $tvInfo,
			'results'     => $results
		]);
	}

	/**
	 * Creates a proper date object from a date & time.
	 *
	 * @param  string $date
	 * @param  string $time
	 * @return object
	 */
	private function createDate($date, $time)
	{
		return Carbon::parse($date . ' ' . $time);
	}

	/**
	 * Determine if the string is TV information. TV info does not
	 * usually contain a colon.
	 *
	 * @param $info
	 * @return null|string
	 */
	private function getTvInfo($info)
	{
		return strpos($info, ':') === false ? strip_tags($info) : null;
	}

	/**
	 * Determine if the string is match results. Results usually contain
	 * a colon.
	 *
	 * @param $info
	 * @return null|string
	 */
	private function getResults($info)
	{
		return strpos($info, ':') !== false ? strip_tags($info) : null;
	}

}