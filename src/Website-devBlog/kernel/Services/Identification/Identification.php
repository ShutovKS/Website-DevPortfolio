<?php

namespace App\Kernel\Services\Identification;

use App\Kernel\Services\Config\ConfigInterface;
use App\Kernel\Services\Cookie\CookieInterface;
use App\Kernel\Services\Session\SessionInterface;
use App\Models\User;
use Random\RandomException;

readonly class Identification implements IdentificationInterface
{
    public function __construct(
        private SessionInterface $session,
        private ConfigInterface $config,
        private CookieInterface $cookie,
    )
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
        $user->isAuthor = true;
        $user->isAdmin = false;

        $insertId = $user->save();

        return $insertId !== false;
    }

    public function login(string $email, string $password, bool $remember = false): ?User
    {
        /** @var User $user */
        $user = User::where(['email' => $email])[0] ?? null;

        if (!$user || !hash_equals($user->passwordHash, $this->hashPassword($password, $user->salt))) {
            return null;
        }

        $this->setUser($user);

        if ($remember) {
            $this->setRememberMeCookie($user);
        }

        return $user;
    }

    public function logout(): void
    {
        $this->session->remove($this->config->get('identification.email'));
        $this->session->remove($this->config->get('identification.username'));
        $this->session->remove($this->config->get('identification.session_field'));

        $this->cookie->deleteCookie($this->config->get('identification.cookie_name'));
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
        if (!$this->session->has($this->config->get('identification.session_field'))) {
            $this->checkRememberMeCookie();
        }

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

    public function checkPassword(string $password): bool
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            return false;
        }

        return $this->hashPassword($password, $user->salt) === $user->passwordHash;
    }

    public function updatePassword(string $password): void
    {
        /** @var User $user */
        $user = $this->getUser();
        $salt = $this->generateSalt();
        $password_hash = $this->hashPassword($password, $salt);

        $user->passwordHash = $password_hash;
        $user->salt = $salt;
        $user->save();
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

    private function setRememberMeCookie(User $user): void
    {
        $token = bin2hex(random_bytes(16));
        $user->rememberToken = $token;
        $user->save();

        $cookieValue = base64_encode(json_encode(['id' => $user->id, 'token' => $token], JSON_THROW_ON_ERROR));
        $this->cookie->setCookie(
            $this->config->get('identification.cookie_name'),
            $cookieValue,
            $this->config->get('identification.cookie_lifetime'),
            $this->config->get('identification.cookie_path'),
            $this->config->get('identification.cookie_domain'),
            $this->config->get('identification.cookie_secure'),
            $this->config->get('identification.cookie_httponly')
        );
    }

    private function checkRememberMeCookie(): void
    {
        $cookieValue = $this->cookie->getCookie($this->config->get('identification.cookie_name'));

        if ($cookieValue) {
            $data = json_decode(base64_decode($cookieValue), true, 512, JSON_THROW_ON_ERROR);

            if (isset($data['id'], $data['token'])) {
                /** @var User $user */
                $user = User::find($data['id']);

                if ($user && hash_equals($user->rememberToken, $data['token'])) {
                    $this->setUser($user);
                }
            }
        }
    }
}
