<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Patient;


class GetById
{
    public $result;

    public function __construct(int $id)
    {
        $patient = new Patient;
        $this->result = $patient->fetchById($id);
        $patient->getResult();
    } 
} 