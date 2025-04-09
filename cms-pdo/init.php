<?php
// autoload classes
require_once "autoloader.php";

// start the session
session_start();

// import files 
require_once "config/config.php";
require_once "helpers.php";

// define global constants
define("APP_NAME", "CMS PDO System");
define("PROJECT_DIR", 'cms-pdo');
?>