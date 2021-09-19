<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models\EloquentORM;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Shopkeeper shopkeeper
 */

class User extends Model
{
    use HasFactory;

    protected $model = "users";

    protected $fillable = [
        'id',
        'name',
        'email',
        'cpf',
        'password',
    ];

    public function shopkeeper(): HasOne
    {
        return $this->hasOne(Shopkeeper::class);
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
