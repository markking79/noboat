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

    public function getById ($id)
    {
        return $this->userRepository->getById($id, $data);
    }

    public function update ($id, $data)
    {
        $this->userRepository->update($id, $data);
    }
}