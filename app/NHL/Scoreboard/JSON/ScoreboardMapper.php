<?php

namespace NHL\Scoreboard\JSON;

use Carbon\Carbon;
use NHL\Scoreboard\ScoreboardImporter as ScoreboardImporterInterface;

class ScoreboardMapper implements ScoreboardImporterInterface {

    /**
     * @var ScoreboardImporter
     */
    private $scoreboardImporter;

    public function __construct(ScoreboardImporter $scoreboardImporter)
    {
        $this->scoreboardImporter = $scoreboardImporter;
    }

    public function byDay(Carbon $date)
    {
        $games = $this->scoreboardImporter->byDay($date);

        return $games->map(function($game) use($date)
        {
            $bs = array_get($game, 'bs');
            $overtime = stripos($bs, 'OT') === false ? false : true;
            $shootout = stripos($bs, 'SO') === false ? false : true;

            return [
                'home' => [
                    'team_id' => array_get($game, 'hta'),
                    'score' => (int) array_get($game, 'hts'),
                    'shots_on_goal' => array_get($game, 'htsog')
                ],

                'away' => [
                    'team_id' => array_get($game, 'ata'),
                    'score' => (int) array_get($game, 'ats'),
                    'shots_on_goal' => array_get($game, 'atsog')
                ],

                'status'    => array_get($game, 'bsc'),
                'time'      => array_get($game, 'bs'),
                'shootout'  => $shootout,
                'overtime'  => $overtime,
                'date'      => $date
            ];
        });
    }
}