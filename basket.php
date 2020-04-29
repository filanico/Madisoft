<?php

class App
{
    function formatSoccerPlayer()
    {
        $sp = new SoccerPlayer();
        $spf = new SoccerPlayerFormatter();

        $spf->format($sp);
    }
}

class SoccerPlayer
{
    private $name;

    private $surname;

    private $goals;

    private $assists;

    private $ycNr;

    private $rcNr;

    private $gamePlayed;

    public function getFullName(): string
    {
        return "{$this->name} {$this->surname}";
    }

    public function getStatsDescription(): string
    {
        return "I've scored {$this->goals} in {$this->gamePlayed} match(es). I've also made {$this->assists}. Other stats: {$this->ycNr} yellow card(s) and {$this->rcNr} red card(s)";
  }
}

class SoccerPlayerFormatter
{
    public function format(SoccerPlayer $player): void
    {
        echo "Here comes {$player->getFullName()}";
        echo "Stats from {$player->getFullName()} {$player->getStatsDescription()}";
    }
}