<?php

namespace backend\validators;

use backend\validators\Validator;

class EmailValidator implements Validator
{
    private $message;

    public function __construct($message)
    {
       $this->message = $message;
    }

    public function isValid($data): bool
    {
        $email = filter_var($data, FILTER_VALIDATE_EMAIL);
        return is_string($email); 
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}