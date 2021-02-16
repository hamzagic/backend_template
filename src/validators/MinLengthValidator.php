<?php

namespace backend\validators;

use backend\validators\Validator;

class MinLengthValidator implements Validator
{
    private $message;
    private $minLength;

    public function __construct(string $message, int $minLength)
    {
        $this->message = $message;
        $this->minLength = $minLength;
    }
    public function isValid($data): bool
    {
        return is_string($data) && strlen($data) >= $this->minLength;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}