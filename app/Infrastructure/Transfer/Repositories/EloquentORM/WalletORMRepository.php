<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories\EloquentORM;

use Infrastructure\Transfer\Models\EloquentORM\Wallet;
use Infrastructure\Transfer\Repositories\WalletRepositoryInterface;

class WalletORMRepository extends AbstractORMRepository implements WalletRepositoryInterface
{
    public function __construct()
    {
        $this->model = new Wallet();
    }
}
