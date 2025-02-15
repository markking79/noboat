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

    public function store ($user_id)
    {
        return Pack::create ([
            'user_id' => $user_id,
            'name' => 'My Pack'
        ]);
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

                $whereArray[] = ['season_id', '=', $season_id];
            }
            //dd ($whereArray);

            return Pack::where($whereArray)->with (['season', 'likes'])->orderBy ('heart_count', 'desc')->paginate(21);
        });

        return $data;
    }

    public function getAllByUserIdWithSeasonPaginate ($user_id, $page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id)
    {
        $data = Cache::tags('packs')->remember('packs-'.$user_id.'_'.$page.'_'.$ounces_min.'_'.$ounces_max.'_'.$cost_min.'_'.$cost_max.'_'.$season_id, $this->secondsCache, function () use ($user_id, $page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id) {

            $whereArray = [];
            $whereArray[] = ['user_id', '=', $user_id];

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

            return Pack::where($whereArray)->with (['season', 'likes'])->orderBy ('created_at', 'desc')->paginate(21);
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

    public function update ($id, $values)
    {
        $item = $this->getById($id);
        if ($item)
        {
            $item->fill ($values);
            $item->save ();
        }

    }

    public function delete ($id)
    {
        $packWithItems = $this->getByIdWithAllPackItems ($id);

        if ($packWithItems->items)
        {
            foreach ($packWithItems->items as $item)
            {
                $item->delete ();

            }
        }
        Pack::destroy ($id);
    }

    public function clearCache ()
    {
        Cache::tags('packs')->flush();
    }
}