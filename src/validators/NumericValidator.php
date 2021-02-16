<?php

namespace backend\validators;

use backend\validators\Validator;

class NumericValidator implements Validator
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
    public function isValid($data): bool
    {
        return is_int($data) || is_numeric($data);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}