<?php

namespace App\Repositories;

interface PackRepositoryInterface
{
    public function getAllWithSeasonPaginate($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);
    public function getByIdWithAllPackItems($id);
}