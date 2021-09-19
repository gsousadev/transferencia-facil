<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Wallet;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Repositories\WalletRepositoryInterface;

class WalletRepository extends AbstractRepository
{
    public function __construct(WalletRepositoryInterface $repository)
    {
        $this->externalRepository = $repository;
    }

    public function getEntity(): EntityInterface
    {
        return new Wallet();
    }
}
