<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Infrastructure\Transfer\Models\EloquentORM\Transaction;
use Infrastructure\Transfer\Repositories\TransactionRepositoryInterface;

class TransactionORMRepository extends AbstractORMRepository implements TransactionRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Transaction();
    }
}
