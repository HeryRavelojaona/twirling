<?php

require '../config/dev.php';
require '../config/DateTimeFrench.php';
require '../vendor/autoload.php';

session_start();
$router = new \Spac\config\Router();
$router->run();