<?php

namespace App\Kernel\Services\Identification;

use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Database\DatabaseInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Models\User;


class Identification implements IdentificationInterface
{
    public function __construct(
        private readonly DatabaseInterface $db,
        private readonly SessionInterface  $session,
        private readonly ConfigInterface   $config)
    {
    }

    public function register(string $name, string $email, string $password): bool
    {
        if (User::where(['email' => $email])) {
            return false;
        }

        $salt = $this->generateSalt();
        $password_hash = $this->hashPassword($password, $salt);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password_hash = $password_hash;
        $user->salt = $salt;
        $user->created_at = date('Y-m-d H:i:s');
        $user->updated_at = date('Y-m-d H:i:s');
        $user->is_author = false;
        $user->is_admin = false;

        $insertId = $user->save();

        return $insertId !== false;
    }

    public function login(string $email, string $password): ?User
    {
        $user = User::where(['email' => $email])[0] ?? null;

        if (!$user || !hash_equals($user->password_hash, hash('sha256', $password . $user->salt))) {
            return null;
        }

        return $user;
    }

    public function logout(): void
    {
        $this->session->remove('user');
    }

    public function getUser(): ?User
    {
        return $this->session->get('user');
    }

    public function setUser(User $user): void
    {
        $this->session->set('user', $user);
    }

    public function isAuthorized(): bool
    {
        return $this->session->has('user');
    }

    public function exists(string $email): bool
    {
        return User::where(['email' => $email]) !== [];
    }

    private function hashPassword(string $password, string $salt): string
    {
        return hash('sha256', $password . $salt);
    }

    private function generateSalt(): string
    {
        return bin2hex(random_bytes(16));
    }
}
