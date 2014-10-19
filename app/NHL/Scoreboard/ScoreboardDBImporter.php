<?php

namespace NHL\Scoreboard;

use Carbon\Carbon;
use NHL\Storage\Match\MatchRepository;
use NHL\Storage\Score\ScoreRepository;
use Score;

class ScoreboardDBImporter implements ScoreboardImporter {

    /**
     * @var MatchRepository
     */
    private $matchRepo;

    /**
     * @var ScoreboardImporter
     */
    private $scoreboardImporter;
    /**
     * @var ScoreRepository
     */
    private $scoreRepo;

    /**
     * @param ScoreboardImporter $scoreboardImporter
     * @param MatchRepository $matchRepo
     * @param ScoreRepository $scoreRepo
     */
    public function __construct(ScoreboardImporter $scoreboardImporter, MatchRepository $matchRepo, ScoreRepository $scoreRepo)
    {
        $this->matchRepo = $matchRepo;
        $this->scoreboardImporter = $scoreboardImporter;
        $this->scoreRepo = $scoreRepo;
    }

    /**
     * @param Carbon $date
     */
    public function byDay(Carbon $date)
    {
        $games   = $this->scoreboardImporter->byDay($date);
        $matches = $this->matchRepo->get($games->fetch('home.team_id')->toArray(), $date);

        foreach ($games as $game)
        {
            $match = $matches->first(function($key, $value) use($game)
            {
                return $value->home_team === $game['home']['team_id'] &&
                    $value->away_team === $game['away']['team_id'];
            });

            if ($match && in_array($game['status'], ['final', 'progress']))
            {
                $this->saveScore($game, $match->scores, $match->id);
            }
        }
    }

    /**
     * @param $game
     * @param $scores
     * @param $matchId
     */
    private function saveScore($game, $scores, $matchId)
    {
        $score = [
            new Score([
                'team_id' => $game['home']['team_id'],
                'score' => $game['home']['score'],
                'shootout' => $game['shootout'],
                'overtime' => $game['overtime'],
                'game_status' => $game['status']
            ]),
            new Score([
                'team_id' => $game['away']['team_id'],
                'score' => $game['away']['score'],
                'shootout' => $game['shootout'],
                'overtime' => $game['overtime'],
                'game_status' => $game['status']
            ])
        ];

        if ($scores->isEmpty())
        {
            $this->scoreRepo->saveScoreToMatch($matchId, $score);
        }
        else
        {
            $this->scoreRepo->updateMatchScore($matchId, $score);
        }
    }
}