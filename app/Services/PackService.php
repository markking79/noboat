<?php

namespace App\Services;

use App\Repositories\PackRepository;

class PackService
{

    public $packRepository;

    public function __construct(PackRepository $packRepository)
    {
        $this->packRepository = $packRepository;
    }

    public function getByIdWithOnlyPublicPackItems ($id, $pack_weight_units = 'Imperial')
    {
        $pack = $this->packRepository->getByIdWithAllPackItems($id);
        return $pack;
    }
}