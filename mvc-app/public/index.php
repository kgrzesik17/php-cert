<?php 
require_once __DIR__ . '/../app/init.php';
require_once __DIR__ . '/../routes/web.php';

// detect if there's a get request
// $request = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';

$method = $_SERVER['REQUEST_METHOD'];
$request = trim_local(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

if(isset($routes[$method][$request])) {
    list($controller, $action) = explode('@', $routes[$method][$request]);

    require_once __DIR__ . '/../app/controllers/' . $controller . '.php';

    $controllerInstance = new $controller;
    $controllerInstance->$action();
} else {
    // http_response_code(404);
    // echo "404 Not found";
}

// if(array_key_exists($request, $routes)) {

//     $route = explode('@', $routes[$request]);
//     $controllerName = $route[0];
//     $methodName = $route[1];
//     $controller = new $controllerName();
//     $controller->$methodName();

// } else {
//     echo "404 - Page not found";
// } 