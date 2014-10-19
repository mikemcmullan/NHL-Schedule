<?php

namespace NHL\Schedule\HTML;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use Carbon\Carbon;

class ScheduleMapper implements ScheduleImporterInterface {

    /**
     * @var ScheduleImporter
     */
    private $scheduleImporter;

    /**
     * @var string
     */
    private $teamId = '';

    /**
     * @param ScheduleImporter $scheduleImporter
     */
    public function __construct(ScheduleImporter $scheduleImporter)
    {
        $this->scheduleImporter = $scheduleImporter;
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
     * @param $string
     * @return mixed
     */
    private function stripHTMLComments($string)
    {
        return trim(preg_replace('/<!--(.|\s)*?-->/', '', $string));
    }

    /**
     * Creates a unique identifier based on the date & time.
     *
     * @param  string $teamID
     * @param  string $date
     * @param  string $time
     * @return object
     */
    private function createUid($teamID, $date, $time)
    {
        $dateTime = $this->createDate($date, $time);

        return $teamID . $dateTime->format('YmdHis');
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

        $info = $this->stripHTMLComments(head($match->find('.tvInfo'))->innertext);

        $tvInfo = $this->getTvInfo($info);
        $results = $this->getResults($info);

        $teams = [
            'home' => getTeamID(trim(array_get($match->find('.team .teamName'), 1)->plaintext)),
            'away' => getTeamID(trim(array_get($match->find('.team .teamName'), 0)->plaintext))
        ];

        return [
            'uid'         => $this->createUid($this->teamId, $date, $time),
            'date'        => $this->createDate($date, $time),
            'home'        => $teams['home'],
            'away'        => $teams['away'],
            'tv_info'     => $tvInfo,
            'results'     => $results
        ];
    }

    /**
     * Import the entire season schedule for a particular team.
     *
     * @param $teamId
     * @return array
     */
    public function bySeason($teamId)
    {
        $schedule = $this->scheduleImporter->bySeason($teamId);

        $this->teamId = $teamId;

        return array_filter(array_map([$this, 'mapMatches'], $schedule));
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