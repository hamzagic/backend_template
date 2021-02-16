<?php

namespace backend\connection;

use PDO;
use PDOStatement;

class Base 
{
    protected $dbConnection;
    protected $dbResult;
    protected $dbError = null;

    public function init(PDO $argDbConnection)
    {
        $this->dbConnection = $argDbConnection;
    }

    public function getResult()
    {
        return $this->dbResult;
    }

    public function setResult($argResult)
    {
        $this->dbResult = $argResult;
    }

    public function getError()
    {
        return $this->dbError;
    }

    protected function handleDbError(PDOStatement $argStatement = null)
    {
        $dbErrorInfo = is_null($argStatement) ? $this->dbConnection->errorInfo() : $argStatement->errorInfo();
        $this->dbError = $dbErrorInfo[0];
    }
}