<?php

namespace App\Kernel\Services\Config;

interface ConfigInterface
{
    public function get(string $key): mixed;
}