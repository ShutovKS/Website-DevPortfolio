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
        }

        return null;
    }
}

