<?php

namespace App\Repositories;

use App\PackSeason;
use Illuminate\Support\Facades\Cache;

class PackSeasonRepository implements PackSeasonRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }

    public function getAll ()
    {
        $data = Cache::tags('pack_seasons')->remember('pack_seasons', $this->secondsCache, function () {
            return PackSeason::orderBy ('weight')->get ();
        });

        return $data;
    }

    public function clearCache ()
    {
        Cache::tags('pack_seasons')->flush();
    }
}