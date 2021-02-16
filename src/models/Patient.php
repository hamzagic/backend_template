<?php

namespace backend\models;

use backend\connection\Database;
use backend\models\Credentials;
use PDO;

class Patient
{
    private $db;
    private $result;
    private $message = null;
    private $dbh;

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function create($data)
    {
        $emailExists = $this->checkEmailExists($data['email']);
        if($emailExists) {
            $response = array("message" => "Email already exists");
            echo json_encode($response);
        } else {
            $this->dbh = $this->db->connect();
            $this->dbh->beginTransaction();
            try {
            $this->db->query('INSERT INTO patient (first_name, last_name, email, gender, birth_date) VALUES (:fn,:ln,:em,:g,:bd)');
                $this->db->bind($data['first_name'], ':fn');
                $this->db->bind($data['last_name'], ':ln');
                $this->db->bind($data['email'], ':em');
                $this->db->bind($data['gender'], ':g');
                $this->db->bind($data['birth_date'], ':bd');
                $this->result = $this->db->returnResult();
                $this->fetchByEmail($data['email']);
                $fetch = $this->fetchByEmailRaw($data['email']);
                $new_id = $this->getRowData($fetch);
                $this->createCredential($data['email'], $data['pwd'], $new_id);
                $this->dbh->commit();
            } catch(\Exception $e) {
                echo $e->getMessage();
                $this->dbh->rollBack();
            }
        }
    }

    public function createCredential($email, $pwd, $id)
    {
        $user = new Credentials;
        try {
            $user->createCredential($email, $pwd, $id);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getRowData($row)
    {
        $num = $row->rowCount();
        if($num > 0) {
            try {
               while($rowData = $row->fetch(\PDO::FETCH_ASSOC)) {
                 extract($rowData);
                 return $rowData['id'];
               }
               
            } catch(\Exception $e) {
                echo $e->getMessage();
            }
            
        }
    }
    
    public function fetch()
    {
        $this->db->query('SELECT * FROM patient');
        $this->result = $this->db->returnResult();
        return $this->result; 
    }

    public function getResult()
    {
        $num = $this->result->rowCount();
        if($num > 0) {
            $patient_array = array(); 
            $patient_array['data'] = array();

            while($row = $this->result->fetch(\PDO::FETCH_ASSOC)) {
                extract($row);

                $patient = array(
                    'id' => $row['id'],
                    'First Name' => $row['first_name'],
                    'Last Name' => $row['last_name'],
                    'Email' => $row['email'],
                    'Gender' => $row['gender'],
                    'Birth Date' => $row['birth_date'],  
                    'Is Active' => $row['active'],
                    'Created' => $row['created_at'],
                    'Updated' => $row['updated_at']
                );
                array_push($patient_array['data'], $patient);
            }
            echo json_encode($patient_array);
        }
    }

    public function fetchById(int $id)
    {
        $param = ':id';
        $this->db->query('SELECT * FROM patient WHERE id=' . $param);
        $this->db->bind($id, $param);
        $this->result = $this->db->returnResult();
    }

    public function fetchByEmail(string $email)
    {
        $param = ':email';
        $this->db->query('SELECT * FROM patient WHERE email=' . $param);
        $this->db->bind($email, $param);
        $this->result = $this->db->returnResult();
        $this->getResult();
    }

    public function fetchByEmailRaw(string $email)
    {
        $param = ':email';
        $this->db->query('SELECT * FROM patient WHERE email=' . $param);
        $this->db->bind($email, $param);
        $this->result = $this->db->returnResult();
        return $this->result;
    }

    public function checkEmailExists(string $email)
    {
        $param = ':email';
        $this->db->query('SELECT * FROM patient WHERE email=' . $param);
        $this->db->bind($email, $param);
        $this->result = $this->db->returnResult();
        return $this->result->rowCount() > 0;
    }
}