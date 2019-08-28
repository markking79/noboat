<?php

namespace App\Repositories;

interface PackAutoCompleteRepositoryInterface
{
    public function getAllPaginate ($page);

    public function search ($terms);

    public function delete ($id);

    public function clearCache ();
}