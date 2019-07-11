<?php

namespace App\Repositories;

use App\Pack;
use Illuminate\Support\Facades\Cache;

class PackRepository implements PackRepositoryInterface
{

    private $secondsCache = 60;//60*60*24;

    public function getAll ()
    {

    }

    public function getAllPaginate ($page)
    {

    }

    public function getByIdWithAllPackItems ($id)
    {
        $data = Cache::tags('pack-'.$id)->remember('pack-'.$id, $this->secondsCache, function () use ($id) {
            return Pack::where ('id', $id)->with (['user', 'items'])->first ();
        });

        return $data;
    }
}