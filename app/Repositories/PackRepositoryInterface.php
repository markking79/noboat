<?php

namespace App\Repositories;

interface PackRepositoryInterface
{
    public function store ($user_id);
    public function getAllWithSeasonPaginate($page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);
    public function getAllByUserIdWithSeasonPaginate($user_id, $page, $ounces_min, $ounces_max, $cost_min, $cost_max, $season_id);
    public function getById($id);
    public function getByIdWithAllPackItems($id);
    public function update ($id, $values);
    public function clearCache ();
}