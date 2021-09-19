<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models\EloquentORM;

use Database\Factories\WalletFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Wallet extends Model
{
    use HasFactory;

    protected $model = "wallets";

    protected $fillable = [
        'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory()
    {
        return WalletFactory::new();
    }
}
