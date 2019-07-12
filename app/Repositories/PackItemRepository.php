<?php

namespace App\Repositories;


class PackItemRepository implements PackItemRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }
}