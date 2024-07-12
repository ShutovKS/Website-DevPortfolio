<?php

namespace App\Kernel\Validator;

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

                $error = $this->validateRule($data[$key], $item, $ruleValue);

                if ($error) {
                    $errors[$key] = $error;
                    break;
                }
            }
        }

        return $errors;
    }

    private function validateRule(mixed $value, string $ruleName, ?string $ruleValue): ?string
    {
        switch ($ruleName) {
            case 'required':
                if (empty($value)) {
                    return 'Поле обязательно';
                }
                break;
            case 'min':
                if (strlen($value) < $ruleValue) {
                    return 'Поле должно быть не менее ' . $ruleValue . ' символов, а вы ввели ' . strlen($value) . ' символов';
                }
                break;
            case 'max':
                if (strlen($value) > $ruleValue) {
                    return 'Поле должно быть не более ' . $ruleValue . ' символов, а вы ввели ' . strlen($value) . ' символов';
                }
                break;
            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    return 'Поле должно быть валидным email адресом';
                }
                break;
        }

        return null;
    }
}

interface ValidatorInterface
{
    public function validate(array $data, array $rules): array;
}