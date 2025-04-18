<?php

// $routes = [
//     '' => 'HomeController@index',
//     'about' => 'HomeController@about',
//     'user/register' => 'UserController@register',
// ];

$router = new Route();
$router->get('/user/test/{id}', 'UserController@test');

$router->dispatch();

$router->get('/user/test', 'UserController@test');

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/about' => 'HomeController@about',
        '/contact' => 'HomeController@contact',
        '/user/register' => 'UserController@showRegisterForm',
        '/user/login' => 'UserController@showLoginForm',
        '/dashboard' => 'AdminController@dashboard',  // bad! should be /admin/dashboard 
        '/admin' => 'AdminController@admin',
        '/admin/users/profile' => 'UserController@showProfile',
    ],
    
    'POST' => [
        '/register' => "UserController@register",
        '/login' => "UserController@loginUser",
        '/logout' => "UserController@logout",
        '/admin/user/update' => 'UserController@updateProfile',
        '/admin/profile/user/password/update' => 'UserController@updateUserProfilePassword',
    ]
];