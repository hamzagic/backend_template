<?php

return [
    [
        'uri_path_pattern' => '/^patient\/(?<id>[0-9]+)$/',
        'method' => 'GET',
        'handler_path' => '/patient/GetById.php',
        'handler_classname' => 'api\\patient\\GetById',
        'handler_class' => 'GetById' 
    ],
    [
        'uri_path_pattern' => '/^patient$/',
        'method' => 'GET',
        'handler_path' => '/patient/Get.php',
        'handler_classname' => 'api\\patient\\Get',
        'handler_class' => 'Get' 
    ],
    [
        'uri_path_pattern' => '/^patient$/',
        'method' => 'POST',
        'handler_path' => '/patient/Create.php',
        'handler_classname' => 'api\\patient\\Create',
        'handler_class' => 'Create'
    ],
    [
        'uri_path_pattern' => '/^patient\/email$/',
        'method' => 'POST',
        'handler_path' => '/patient/GetByEmail.php',
        'handler_classname' => 'api\\patient\\GetByEmail',
        'handler_class' => 'GetByEmail'
    ],
    [
        'uri_path_pattern' => '/^patient$/',
        'method' => 'PUT',
        'handler_path' => '/patient/Update.php',
        'handler_classname' => 'api\\patient\\Create',
        'handler_class' => 'Update'
    ],
    [
        'uri_path_pattern' => '/^connect\/login$/',
        'method' => 'POST',
        'handler_path' => '/connect/Login.php',
        'handler_classname' => 'api\\connect\\Login',
        'handler_class' => 'Login'
    ],
];