<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

use Domain\Transfer\Entities\WalletInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Wallet extends Model implements WalletInterface
{
    protected $model = "wallets";

    /** @var int */
    private $id;
    /** @var float */
    private $balance;

    protected $fillable = [
        'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
