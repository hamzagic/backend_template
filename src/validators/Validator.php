<?php

namespace backend\validators;

interface Validator
{
    public function isValid($data): bool;
    public function getMessage(): string;
}