<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

use Infrastructure\Transfer\Models\EntityAbstract;
use Infrastructure\Transfer\Models\UserInterface;

class User extends EntityAbstract implements UserInterface
{
    private $name;
    private $email;
    private $cpf;
    private $password;

    protected $requiredFields = [
        'name',
        'email',
        'cpf',
        'password'
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
