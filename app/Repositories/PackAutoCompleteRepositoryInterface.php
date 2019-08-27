<?php

namespace App\Repositories;

interface PackAutoCompleteRepositoryInterface
{
    public function getAllPaginate ($page);

    public function clearCache ();
}