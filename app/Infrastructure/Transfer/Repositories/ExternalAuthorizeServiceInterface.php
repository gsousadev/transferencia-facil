<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Repositories;

interface ExternalAuthorizeServiceInterface
{
    public function verify(array $transaction): bool;
}

