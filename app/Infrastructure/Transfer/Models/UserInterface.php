<?php

declare(strict_types=1);

namespace Infrastructure\Transfer\Models;

interface UserInterface
{
    public function getName(): string;
    public function setName(string $value): void;
    public function getEmail(): string;
    public function setEmail(string $value): void;
    public function getCpf(): string;
    public function setCpf(string $value): void;
    public function getPassword(): string;
    public function setPassword(string $value): void;
}
