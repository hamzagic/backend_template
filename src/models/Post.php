<?php

namespace backend\models;

use backend\connection\Database;

//include_once '../connection/Database.php';

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
       $this->db->query('SELECT * FROM posts');
       return $this->db->returnResult();  
    }

    public function getById($id)
    {
        $param = ':id';
        $this->db->query('SELECT * FROM posts WHERE id=' . $param);
        $this->db->bind($id, $param);
        return $this->db->returnResult();
    }

}