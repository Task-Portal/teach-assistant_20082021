<?php

session_start();
require_once('sys/lib/autoloader.php');
$router = new \sys\lib\Router;
$router->run();
