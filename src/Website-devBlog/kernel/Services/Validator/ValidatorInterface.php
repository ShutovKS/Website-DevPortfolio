<?php

namespace App\Kernel\Services\Validator;

interface ValidatorInterface
{
    public function validate(array $data, array $rules): array;
}