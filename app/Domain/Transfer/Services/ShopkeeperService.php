<?php

namespace Domain\Transfer\Services;

use Domain\Transfer\Repositories\ShopkeeperRepository;

class ShopkeeperService
{
    /** @var ShopkeeperRepository */
    private $shopkeeperRepository;

    public function __construct(
        ShopkeeperRepository $shopkeeperRepository
    ) {
        $this->shopkeeperRepository = $shopkeeperRepository;
    }

    public function find(array $filters = []): array
    {
        return $this->shopkeeperRepository->find($filters);
    }
}
