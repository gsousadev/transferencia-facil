<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Shopkeepers shopkeeper
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
        return $this->hasOne(Shopkeepers::class);
    }
}
