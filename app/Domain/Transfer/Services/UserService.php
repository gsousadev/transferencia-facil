<?php

namespace Domain\Transfer\Services;

use Domain\Transfer\Repositories\UserRepository;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        UserRepository $userRepository
    ) {
        $this->userRepository = $userRepository;
    }

    public function find(array $filters = []): array
    {
        return $this->userRepository->find($filters);
    }
}
