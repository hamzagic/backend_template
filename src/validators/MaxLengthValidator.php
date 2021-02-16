<?php

namespace backend\validators;

use backend\validators\Validator;

class MaxLengthValidator implements Validator
{
    private $message;
    private $maxLength;

    public function __construct(string $message, int $maxLength)
    {
        $this->message = $message;
        $this->maxLength = $maxLength;
    }
    public function isValid($data): bool
    {
        return is_string($data) && strlen($data) <= $this->maxLength;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}