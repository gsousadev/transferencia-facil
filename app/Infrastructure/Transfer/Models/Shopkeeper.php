<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

use Domain\Transfer\Entities\ShopkeeperInterface;
use Database\Factories\ShopkeeperFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Shopkeeper extends Model implements ShopkeeperInterface
{
    use HasFactory;

    protected $model = "shopkeepers";
    /** @var int */
    private $id;
    /** @var string */
    private $cnpj;
    /** @var string */
    private $tradingName;
    /** @var int */
    private $userId;


    protected $fillable = [
        'cnpj',
        'trading_name',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getCNPJ(): string
    {
        return $this->cnpj;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getTradingName(): string
    {
        return $this->tradingName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected static function newFactory()
    {
        return ShopkeeperFactory::new();
    }
}
