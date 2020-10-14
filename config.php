<?php

session_start();

/*|| DEFINE URL || */

define('BASE_URL', 'http://localhost/NewsApp/');


/*|| DATABASE CONNECTION || */

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'news_db');
define('DB_PORT', '3308');

try {
    $pdo = new PDO('mysql:host=' . DB_SERVER . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('<div class="alert alert-danger" role="alert">There was an error establishing connection with database!</div>' . $e->getMessage());
}

/*|| CLASS AUTOLOAD || */

function autoload($classname)
{
    require_once "classes/{$classname}.class.php";
    //require_once "classes/" . str_replace("\\", "/", $classname) . ".php";
}

spl_autoload_register('autoload');
