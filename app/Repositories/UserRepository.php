<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    private $secondsCache = 1;

    function __construct()
    {
        $this->secondsCache = config('custom.seconds_database_cache');
    }

    public function getById ($id)
    {
        $data = Cache::tags('users')->remember('user-'.$id, $this->secondsCache, function () use ($id) {
            return User::where ('id', $id)->first ();
        });

        return $data;
    }

    public function update ($id, $data)
    {
        $user = $this->getById($id);
        $user->name = $data['name'];
        $user->email = $data['email'];

        if ($data['password'])
        {
            $user->password = Hash::make($data['password']);
        }

        $user->touch ();
        $user->save ();
    }

    public function clearCache ()
    {
        Cache::tags('users')->flush();
    }
}