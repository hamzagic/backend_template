<?php

namespace backend\connection;

use backend\connection\Database;

class Model
{
    public $db;
    private $stmt;

    public function __connect()
    {
        $this->db = new Database();
    }

    public function query($query) {
        $this->stmt = $this->db->prepare($query);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function returnResult()
    {
        $this->execute();
        return $this->stmt;
    }

    public function bind($value, $param)
    {
        $this->stmt->bindParam($param, $value);
    }
}
