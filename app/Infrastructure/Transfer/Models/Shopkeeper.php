<?php

declare(strict_types=1);

namespace App\Infrastructure\Transfer\Models;

use App\Domain\Transfer\Entities\ShopkeeperInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User user
 */

class Shopkeeper extends Model implements ShopkeeperInterface
{
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
}
