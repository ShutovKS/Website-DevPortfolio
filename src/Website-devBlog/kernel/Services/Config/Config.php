<?php

namespace App\Kernel\Services\Config;

class Config implements ConfigInterface
{
    public function get(string $key): mixed
    {
        $keys = explode('.', $key);

        $file = array_shift($keys);

        $config = require APP_PATH . '/config/' . $file . '.php';

        foreach ($keys as $keyTemp) {
            $config = $config[$keyTemp];
        }

        return $config;
    }
}