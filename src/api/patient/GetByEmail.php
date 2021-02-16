<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Patient;


class GetByEmail
{
    public $result;

    public function __construct()
    {
        $patient = new Patient;
        $email = rtrim($_POST['email']);
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $this->result = $patient->fetchByEmail($email);
    } 
} 