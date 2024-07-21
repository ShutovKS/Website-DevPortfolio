<?php

namespace App\Kernel\Services\TextSanitizer;

interface TextSanitizerInterface
{
    public function sanitize(string $text): string;
}

