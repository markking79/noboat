<?php

namespace App\Repositories;

interface PackRepositoryInterface
{
    public function getAll();
    public function getAllPaginate($page);
    public function getById($id);
}