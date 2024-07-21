<?php

namespace App\Kernel\Services\TextSanitizer;

class HtmlTextSanitizer implements TextSanitizerInterface
{
    public function sanitize(string $text): string
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}