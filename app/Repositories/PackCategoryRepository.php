<?php

namespace App\Repositories;

use App\PackCategory;
use Illuminate\Support\Facades\Cache;

class PackCategoryRepository implements PackCategoryRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }

    public function getAll ()
    {
        $data = Cache::tags('pack_categories')->remember('pack_categories', $this->secondsCache, function () {
            return PackCategory::orderBy ('weight')->get ();
        });

        return $data;
    }
}