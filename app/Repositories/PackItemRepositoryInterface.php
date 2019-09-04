<?php

namespace App\Repositories;

interface PackItemRepositoryInterface
{
    public function getById ($id);

    public function getByPackId ($pack_id);

    public function store ($values);

    public function update ($id, $values);

    public function resort ($values);

    public function destory ($id);

    public function clearCache ();

}