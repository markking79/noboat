<?php

namespace App\Repositories;

interface PackRepositoryInterface
{
    public function getAllWithSeasonPaginate($page);
    public function getByIdWithAllPackItems($id);
}