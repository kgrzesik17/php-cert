<?php
session_start();
require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/database.php";
const PUBLIC_NAME = 'public';

require_once __DIR__ . "/helpers.php";

// if(!defined('BASE_URL')) {
//     define('BASE_URL', $config=['app']['base_url']);
// }

// auto include every class
spl_autoload_register(function ($class_name) {
    $paths = [
        __DIR__ . "/controllers/",
        __DIR__ . "/models/",
        __DIR__ . "/middlewares/",
        __DIR__ . "/core/",
    ];

    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';

        if(file_exists($file)) {
            require_once $file;
            return;
        }
    }
});