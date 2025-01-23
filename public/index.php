<?php

session_start();

require_once '../vendor/autoload.php';

define('__ROOT__', dirname(__DIR__) . DIRECTORY_SEPARATOR);

use App\Router;

$router = new Router();
$router->run();
