<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

use backend\models\Patient;
use backend\validators\EmailValidator;
use backend\validators\MinLengthValidator;
use backend\validators\MaxLengthValidator;
use backend\validators\NullValidator;
use backend\validators\NumericValidator;
use PDO;

class Create
{
    public function __construct()
    {
        $data = array(
            'email' => rtrim($_POST['email']),
            'first_name' => rtrim($_POST['first_name']),
            'last_name' => rtrim($_POST['last_name']),
            'gender' => rtrim($_POST['gender']),
            'birth_date' => rtrim($_POST['birth_date']),
            'pwd' => rtrim($_POST['pwd']),
        );
        $patient = new Patient();
        $validations = $this->validate($data);
        if(count($validations) > 0) {
            $errors = array('errors' => $validations);
            echo json_encode($errors);
        } else {
            $patient->create($data);
        }
    }

    public function validate($data)
    {
        // TODO validate birth date properly
        // TODO create enum for gender

        $email_validator = new EmailValidator('errors.email.invalid');
        $fname_validator = new MinLengthValidator('errors.fname.minLength', 3);
        $lname_validator = new MinLengthValidator('errors.lname.minLength', 3);
        $gender_validator = new MinLengthValidator('errors.gender.minLength', 4);
        $birthdate_validator = new MinLengthValidator('errors.birthdate.minLength', 10);
        $errors = [];
        $email_validator->isValid($data['email']) ? true : array_push($errors, $email_validator->getMessage());

        $fname_validator->isValid($data['first_name']) ? true : array_push($errors, $fname_validator->getMessage());

        $lname_validator->isValid($data['last_name']) ? true : array_push($errors, $lname_validator->getMessage());

        $gender_validator->isValid($data['gender']) ? true : array_push($errors, $gender_validator->getMessage());

        $birthdate_validator->isValid($data['birth_date']) ? true : array_push($errors, $birthdate_validator->getMessage());

        return $errors;
    }
}