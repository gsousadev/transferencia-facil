<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models\EloquentORM;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User from
 * @property User to
 */

class Transaction extends Model
{
    protected $model = "transactions";

    protected $fillable = [
        'value',
        'status',
        'from_user_id',
        'to_user_id'
    ];

    public function from(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function to(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }
}
