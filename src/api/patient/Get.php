<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Patient;


class Get
{
    public $result;

    public function __construct()
    {
        $patient = new Patient;
        $this->result = $patient->fetch();
        $patient->getResult();
    }
}