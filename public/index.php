<?php
date_default_timezone_set('Europe/Paris');
session_start();
if(file_exists('../vendor/autoload.php')) {
    require('../vendor/autoload.php');
}
// Instance de PDO
$app = \Core\App::getInstance();
// Routes
require('../config/routes.php');
$router = new \Core\Kernel\Router($routes);

