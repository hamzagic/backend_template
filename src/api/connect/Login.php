<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Credentials;

class Login
{
    public $user;
    public function __construct()
    {
        $this->user = new Credentials;
        $this->login();
    }

    public function login()
    {
        // TODO: validate fields
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $this->user->login($email, $pwd);
    }
}