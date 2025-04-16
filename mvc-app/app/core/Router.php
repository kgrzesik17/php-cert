<?php

class Router {
    protected $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get($path, $handler) {
        $this->routes['GET'][$path] = $handler;

        var_dump($this->routes['GET'][$path]);
    }

    public function post() {
        //
    }
}