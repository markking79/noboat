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

    public function getByUuid ($uuid)
    {
        $data = Cache::tags('users')->remember('user_uuid-'.$uuid, $this->secondsCache, function () use ($uuid) {
            return User::where ('uuid', $uuid)->first ();
        });

        if (!$data)
        {
            $data = $this->create(['uuid' => $uuid]);
        }

        return $data;
    }

    public function create ($values)
    {
        return User::create ([
            'uuid' => $values['uuid'],
            'email' => 'fake@fake.com' . $this->createRandomString (),
            'name' => 'Fake',
            'password' => 'Fake'
        ]);
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

    function createRandomString($n = 50) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }
}