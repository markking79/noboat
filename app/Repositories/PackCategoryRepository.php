<?php

namespace App\Repositories;

use App\PackCategory;

class PackCategoryRepository implements PackCategoryRepositoryInterface
{
    public function getAll ()
    {
        return PackCategory::orderBy ('weight')->get ();
    }
}