<?php

// router
class Route {
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($path, $handler) {
        $this->routes['GET'][$this->formatRoute($path)] = $handler;

        var_dump($this->routes['GET'][$path]);
    }

    public function post($path, $handler) {
        $this->routes['POST'][$this->formatRoute($path)] = $handler;
    }

    protected function formatRoute($route) {
        return '/' . trim($route, '/');
    }
}
