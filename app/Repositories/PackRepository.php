<?php

namespace App\Repositories;

use App\Pack;
use Illuminate\Support\Facades\Cache;

class PackRepository implements PackRepositoryInterface
{

    private $secondsCache = 1;//60*60*24;

    public function getAllWithSeasonPaginate ($page)
    {
        $data = Cache::tags('packs')->remember('packs', $this->secondsCache, function () use ($page) {
            return Pack::with (['season'])->paginate(21);
        });

        return $data;
    }

    public function getByIdWithAllPackItems ($id)
    {
        $data = Cache::tags('pack-'.$id)->remember('pack-'.$id, $this->secondsCache, function () use ($id) {
            return Pack::where ('id', $id)->with (['user', 'items', 'season'])->first ();
        });

        return $data;
    }
}