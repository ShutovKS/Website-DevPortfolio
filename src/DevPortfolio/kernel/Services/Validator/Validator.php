<?php

namespace App\Kernel\Services\Validator;

class Validator implements ValidatorInterface
{
    public function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $key => $rule) {
            $rule = explode('|', $rule);

            foreach ($rule as $item) {
                $ruleValue = null;

                if (str_contains($item, ':')) {
                    [$item, $ruleValue] = explode(':', $item);
                }

                $error = $this->validateRule($key, $data[$key], $item, $ruleValue);

                if ($error) {
                    $errors[$key] = $error;
                    break;
                }
            }
        }

        return $errors;
    }

    private function validateRule(string $key, mixed $value, string $ruleName, ?string $ruleValue): ?string
    {
        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return 'Field ' . $key . ' necessarily';
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return 'Field' . $key . ' must be at least ' . $ruleValue. ' characters, and you entered ' . strlen($value) . 'characters';
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return 'Field ' . $key . ' must be no more than ' . $ruleValue . ' characters, and you entered ' . strlen($value) . ' characters';
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'Field ' . $key . ' must be a valid email address';
                }
                break;
            case 'image_url':
                $allowedExtensions = explode(',', $ruleValue);
                $extension = pathinfo($value, PATHINFO_EXTENSION);
                if (!in_array(strtolower($extension), $allowedExtensions)) {
                    return 'Field ' . $key . ' must be a valid image URL';
                }

                $headers = @get_headers($value);
                if (!$headers || !str_contains($headers[0], '200')) {
                    return 'Field ' . $key . ' must be a reachable URL';
                }
                break;
            case 'no_scripts':
                if ($this->containsScripts($value)) {
                    return 'Field ' . $key . ' must not contain HTML or script content';
                }
                break;
            case 'numeric':
                if (!is_numeric($value)) {
                    return 'Field ' . $key . ' must be a numeric value';
                }
                break;
            case 'integer':
                if (!filter_var($value, FILTER_VALIDATE_INT)) {
                    return 'Field ' . $key . ' must be an integer';
                }
                break;
            case 'url':
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    return 'Field ' . $key . ' must be a valid URL';
                }
                break;
            case 'in':
                $allowedValues = explode(',', $ruleValue);
                if (!in_array($value, $allowedValues, true)) {
                    return 'Field ' . $key . ' must be one of the following values: ' . implode(', ', $allowedValues);
                }
                break;
            case 'date':
                if (!strtotime($value)) {
                    return 'Field ' . $key . ' must be a valid date';
                }
                break;
            case 'length':
                if (strlen($value) !== $ruleValue) {
                    return 'Field ' . $key . ' must be exactly ' . $ruleValue . ' characters';
                }
                break;
            case 'ip':
                if (!filter_var($value, FILTER_VALIDATE_IP)) {
                    return 'Field ' . $key . ' must be a valid IP address';
                }
                break;
            case 'between':
                [$min, $max] = explode(',', $ruleValue);
                if ($value < $min || $value > $max) {
                    return 'Field ' . $key . ' must be between ' . $min . ' and ' . $max;
                }
                break;
        }

        return null;
    }

    private function containsScripts(string $value): bool
    {
        // Regular expression to detect HTML tags or JavaScript
        $pattern = '/<[^>]*script.*?>.*?<\/[^>]*script.*?>|<[^>]+>|&lt;[^&]+&gt;|<script.*?>.*?<\/script.*?>/i';
        return preg_match($pattern, $value) === 1;
    }
}

