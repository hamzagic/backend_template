<?php

namespace backend\validators;

use backend\validators\Validator;

class NullValidator implements Validator
{
    private $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }
    public function isValid($data): bool
    {
        return is_null($data);
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}