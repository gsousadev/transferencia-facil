<?php

declare(strict_types=1);

namespace Domain\Transfer\Entities;

interface UserInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getEmail(): string;

    public function getCpf(): string;

    public function getPassword(): string;
}
