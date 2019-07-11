<?php

namespace App\Repositories;

use App\Pack;

class PackRepository implements PackRepositoryInterface
{
    public function getAll ()
    {

    }

    public function getAllPaginate ($page)
    {

    }

    public function getByIdWithAllPackItems ($id)
    {
        return Pack::where ('id', $id)->firstOrFail ();
    }
}