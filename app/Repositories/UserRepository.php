<?php

namespace App\Repositories;


class UserRepository implements UserRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }
}