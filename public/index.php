<?php
require_once '../vendor/autoload.php';

use backend\connection\RequestHandler;

$request = new RequestHandler();
$request->init();
