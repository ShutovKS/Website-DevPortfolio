<?php

namespace App\Kernel\Services\Identification;

use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Models\User;
use Random\RandomException;


readonly class Identification implements IdentificationInterface
{
    public function __construct(
        private SessionInterface $session,
        private ConfigInterface  $config)
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
        $user->username = $name;
        $user->email = $email;
        $user->passwordHash = $password_hash;
        $user->salt = $salt;
        $user->createdAt = date('Y-m-d H:i:s');
        $user->updatedAt = date('Y-m-d H:i:s');
        $user->isAuthor = false;
        $user->isAdmin = false;

        $insertId = $user->save();

        return $insertId !== false;
    }

    public function login(string $email, string $password): ?User
    {
        /** @var User $user */
        $user = User::where(['email' => $email])[0] ?? null;

        if (!$user || !hash_equals($user->passwordHash, hash('sha256', $password . $user->salt))) {
            return null;
        }

        return $user;
    }

    public function logout(): void
    {
        $this->session->remove($this->config->get('identification.email'));
        $this->session->remove($this->config->get('identification.username'));
        $this->session->remove($this->config->get('identification.session_field'));
    }

    public function getUser(): ?User
    {
        if (!$this->isAuth()) {
            return null;
        }

        return User::find($this->session->get($this->config->get('identification.session_field')));
    }

    public function setUser(User $user): void
    {
        $this->session->set($this->config->get('identification.session_field'), $user->id);
        $this->session->set($this->config->get('identification.email'), $user->email);
        $this->session->set($this->config->get('identification.username'), $user->username);
    }

    public function isAuth(): bool
    {
        return $this->session->has($this->config->get('identification.session_field'));
    }

    public function isAdmin(): bool
    {
        return $this->getUser()->isAdmin;
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
        try {
            return bin2hex(random_bytes(16));
        } catch (RandomException) {
        }
    }
}
