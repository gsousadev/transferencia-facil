<?php

declare(strict_types=1);

namespace App\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Shopkeeper shopkeeper
 */

class User extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function shopkeeper(): HasOne
    {
        return $this->hasOne(Shopkeeper::class);
    }
}
