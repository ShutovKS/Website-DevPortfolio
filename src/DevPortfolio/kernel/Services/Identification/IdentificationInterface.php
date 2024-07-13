<?php

namespace App\Kernel\Services\Identification;

use App\Models\User;

interface IdentificationInterface
{
    public function register(string $name, string $email, string $password): bool;

    public function login(string $email, string $password): ?User;

    public function logout(): void;

    public function getUser(): ?User;

    public function setUser(User $user): void;

    public function isAuthorized(): bool;

    public function exists(string $email): bool;
}