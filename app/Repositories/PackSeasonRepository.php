<?php

namespace App\Repositories;


class PackSeasonRepository implements PackSeasonRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }
}