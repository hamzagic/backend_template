<?php

namespace backend\models;

use backend\connection\Database;

class Credentials
{
    private $email;
    private $password;

    private $allowed_hashes = ["sha512", "sha256"];
    public $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function login($arg_email, $arg_password)
    {
        // TODO implement JWT to return a token
        $password = $this->hashPassword($arg_password, 'sha256');
        $query = "SELECT * FROM credentials WHERE email = :email AND pwd = :pwd";
        $this->db->query($query);
        $this->db->bind($arg_email, ':email');
        $this->db->bind($password, ':pwd');
        try {
            $result = $this->db->returnResult();
            $count = $result->rowCount();
            if($count > 0) echo "logged in";
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function hashPassword($arg_password, $algo)
    {
        if(in_array($algo, $this->allowed_hashes)) {
            $hashed_pwd = hash($algo, $arg_password);
            return $hashed_pwd;
        } else {
            return false; // TODO handle responses
        } 
    }

    public function createCredential($arg_email, $arg_pwd, $id)
    {
        $pass = $this->hashPassword($arg_pwd, 'sha256');
        $query = 'INSERT INTO credentials (email, pwd, u_id) VALUES (:email, :pwd, :u_id)';
        $this->db->query($query);
        $this->db->bind($arg_email, ':email');
        $this->db->bind($pass, ':pwd');
        $this->db->bind($id, ':u_id');
        try {
            $this->db->returnResult();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }  
}