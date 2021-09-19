<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models\EloquentORM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Wallet extends Model
{
    protected $model = "wallets";

    protected $fillable = [
        'balance'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
