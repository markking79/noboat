<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getById ($id);

    public function getByUuid ($uuid);

    public function create ($values);

    public function update ($id, $data);

    public function clearCache ();
}