<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models\EloquentORM;

use Database\Factories\ShopkeeperFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Shopkeeper extends Model
{
    use HasFactory;

    protected $model = "shopkeepers";

    protected $fillable = [
        'cnpj',
        'trading_name',
        'user_id'
    ];

    protected static function newFactory()
    {
        return ShopkeeperFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
