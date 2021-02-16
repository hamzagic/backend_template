<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Credentials;

class Connect
{
    public $user;

    public function __construct()
    {
        $this->user = new Credentials;
        $this->createCredential();
    }

    public function createCredential()
    {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $id = $_POST['id'];
        $result = $this->user->createCredential($email, $pwd, $id);
        return $result;
    }
}