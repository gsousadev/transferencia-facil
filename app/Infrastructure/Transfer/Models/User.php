<?php

declare(strict_types=1);

namespace App\Infrastructure\Transfer\Models;

use App\Domain\Transfer\Entities\UserInterface;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property Shopkeeper shopkeeper
 */

class User extends Model implements UserInterface
{
    use HasFactory;

    protected $model = "users";

    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $email;
    /** @var string */
    private $cpf;
    /** @var string */
    private $password;


    protected $fillable = [
        'id',
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

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getId(): int
    {
        return $this->id;
    }

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
