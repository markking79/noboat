<?php

namespace App\Repositories;

interface PackSeasonRepositoryInterface
{
    public function getAll ();
    public function clearCache ();
}