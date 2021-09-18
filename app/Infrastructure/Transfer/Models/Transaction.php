<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

use Domain\Transfer\Entities\TransactionInterface;
use Domain\Transfer\Entities\UserInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User from
 * @property User to
 */

class Transaction extends Model implements TransactionInterface
{
    protected $model = "transactions";

    /** @var int */
    private $id;
    /** @var float */
    private $value;
    /** @var string */
    private $status;

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

    public function getValue(): float
    {
        return $this->value;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFromUser(): UserInterface
    {
        return $this->from;
    }

    public function getToUser(): UserInterface
    {
        return $this->to;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
