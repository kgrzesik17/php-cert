<?php

class HomeController {
    public function index() {

        echo $_SESSION['username'];
        // $data = [

        //     "title" => "Home Page",
        //     "message" => "Welcome to the Home Page",
        // ];

        // render('home/index', $data, 'layouts/hero_layout');
    }

    public function about() {
        $data = [
            "title" => "About Page",
            "message" => "Welcome to the About Page",
        ];

        render('home/about', $data);

        require_once __DIR__ . '/../views/home/about.php';
    }

}