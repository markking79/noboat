<?php

namespace App\Repositories;

use App\Pack;
use Illuminate\Support\Facades\Cache;

class PackRepository implements PackRepositoryInterface
{

    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }


    public function getAllWithSeasonPaginate ($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id)
    {
        $data = Cache::tags('packs')->remember('packs-'.$page.'_'.$ounces_min.'_'.$ounces_max.'_'.$cost_min.'_'.$cost_max.'_'.$season_id, $this->secondsCache, function () use ($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id) {

            $whereArray = [];
            $whereArray[] = ['is_visible', '=', true];

            // ounces
            if ($ounces_min && !$ounces_max)
            {
                $whereArray[] = ['visible_ounces', '>=', $ounces_min];
            }
            else if ($ounces_min && $ounces_max)
            {
                $whereArray[] = ['visible_ounces', '>=', $ounces_min];
                $whereArray[] = ['visible_ounces', '<=', $ounces_max];
            }
            else if (!$ounces_min && $ounces_max)
            {
                $whereArray[] = ['visible_ounces', '<=', $ounces_max];
            }

            // price
            if ($cost_min && !$cost_max)
            {
                $whereArray[] = ['visible_cost', '>=', $cost_min];
            }
            else if ($cost_min && $cost_max)
            {
                $whereArray[] = ['visible_cost', '>=', $cost_min];
                $whereArray[] = ['visible_cost', '<=', $cost_max];
            }
            else if (!$cost_min && $cost_max)
            {
                $whereArray[] = ['visible_cost', '<=', $cost_max];
            }

            // season
            if ($season_id)
            {

                $whereArray[] = ['pack_season_id', '=', $season_id];
            }
            //dd ($whereArray);

            return Pack::where($whereArray)->with (['season'])->orderBy ('heart_count', 'desc')->paginate(21);
        });

        return $data;
    }

    public function getById ($id)
    {
        $data = Cache::tags('packs')->remember('pack-'.$id, $this->secondsCache, function () use ($id) {
            return Pack::where ('id', $id)->first ();
        });

        return $data;
    }

    public function getByIdWithAllPackItems ($id)
    {
        $data = Cache::tags('packs')->remember('pack-with-categories-'.$id, $this->secondsCache, function () use ($id) {
            return Pack::where ('id', $id)->with (['user', 'items', 'season'])->first ();
        });

        return $data;
    }

    public function clearCache ()
    {
        Cache::tags('packs')->flush();
    }
}