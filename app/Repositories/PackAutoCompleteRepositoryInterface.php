<?php

namespace App\Repositories;

interface PackAutoCompleteRepositoryInterface
{
    public function getAllPaginate ($page);

    public function getById ($id);

    public function search ($terms);

    public function store ($values);

    public function delete ($id);

    public function clearCache ();
}