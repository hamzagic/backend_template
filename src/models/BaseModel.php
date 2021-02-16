<?php
/*TODO adds all methods that other model classes will use, such as connection, handle db error, 
fetch data from db, fetch a single data, execute pdo, etc. Basically, getting what was done on Post.php and assign it to a base class.
*/

namespace backend\models;

use backend\connection\Database;
use backend\connection\Model;
use PDO;
use PDOStatement;

class BaseModel
{
    private $db;
    private $stmt;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function fetchAll($query)
    {
       $this->db->query($query);
       return $this->db->returnResult();  
    }

    public function fetchById($id, $param, $table)
    {
        $this->db->query('SELECT * FROM ' . $table .  ' WHERE id=' . $param);
        $this->db->bind($id, $param);
        return $this->db->returnResult();
    }
}