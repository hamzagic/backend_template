<?php

namespace backend\connection;
include_once "../../config.php";

use \PDO as PDO;

class Database
{
    private $host = DB_HOST;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PWD;

    private $error;
    private $dbh;

    public function __construct()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            return $this->dbh;
        } catch (\PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }
    
    public function connect()
    {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db;
        $this->dbh = new PDO($dsn, $this->user, $this->pass);
        return $this->dbh;
    }
    
    //TODO put all methods below in a Base class
    
    public function query($sql) 
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function exec($sql)
    {
        $this->stmt = $this->dbh->exec($sql);
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