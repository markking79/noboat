<?php

namespace App\Repositories;

use App\PackCategory;
use Illuminate\Support\Facades\Cache;

class PackCategoryRepository implements PackCategoryRepositoryInterface
{
    private $secondsCache = 60;//60*60*24;

    public function getAll ()
    {
        $data = Cache::tags('pack_categories')->remember('pack_categories', $this->secondsCache, function () {
            return PackCategory::orderBy ('weight')->get ();
        });

        return $data;
    }
}