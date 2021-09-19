<?php

declare(strict_types=1);

namespace Domain\Transfer\Repositories;

use Domain\Transfer\Entities\Transaction;
use Infrastructure\Transfer\Models\EntityInterface;
use Infrastructure\Transfer\Models\TransactionInterface;
use Infrastructure\Transfer\Repositories\TransactionRepositoryInterface;

class TransactionRepository extends AbstractRepository
{
    public function __construct(TransactionRepositoryInterface $repository)
    {
        $this->externalRepository = $repository;
    }

    public function getEntity(): EntityInterface
    {
        return new Transaction();
    }
}
