<?php

// router
class Route {
    protected $routes = [
        'GET' => ['/user/test' => 'UserController@test'],
        'POST' => [],
    ];

    public function get($path, $handler) {
        $this->routes['GET'][$this->formatRoute($path)] = $handler;

    }

    public function post($path, $handler) {
        $this->routes['POST'][$this->formatRoute($path)] = $handler;
    }
    
    // make sure route is formatted correctly
    protected function formatRoute($route) {
        return '/' . trim($route, '/');
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);  // make sure the uri is clean of spaces, plus symbols, etc.
        $cleanedRequest = $this->formatRoute($requestUri);

        foreach($this->routes[$method] as $route => $handler) {
            
        }
    }
}
