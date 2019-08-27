<?php

namespace App\Repositories;

use App\PackAutoComplete;
use Illuminate\Support\Facades\Cache;

class PackAutoCompleteRepository implements PackAutoCompleteRepositoryInterface
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

    public function getAllPaginate ($page)
    {
        $data = Cache::tags('packautocompletes')->remember('packautocompletes-'.$page, $this->secondsCache, function () use ($page) {

            return PackAutoComplete::paginate(21);
        });

        return $data;

    }

    public function clearCache ()
    {
        Cache::tags('packautocompletes')->flush();
    }

}