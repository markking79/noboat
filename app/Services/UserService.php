<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create ($values)
    {
        return $this->userRepository->create($values);
    }

    public function getById ($id)
    {
        return $this->userRepository->getById($id);
    }

    public function getByUuid ($uuid)
    {
        return $this->userRepository->getByUuid($uuid);
    }

    public function update ($id, $data)
    {
        $this->userRepository->update($id, $data);
    }
}