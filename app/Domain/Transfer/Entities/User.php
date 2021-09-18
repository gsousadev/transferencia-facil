<?php

declare(strict_types=1);

namespace App\Domain\Transfer\Entities;

class User extends Entity implements UserInterface
{
    private $name;
    private $email;
    private $cpf;
    private $password;

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
}
