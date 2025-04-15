<?php

class AdminController {
    public function __construct()
    {
        
    }

    public function dashboard() {
        var_dump(AuthMiddleware::isAuthenticated());

        // $data = [
        //     'title' => 'Dashboard',
        //     'message' => 'Welcome to the Dashboard'
        // ];

        // render('admin/dashboard', $data, 'layouts/admin_layout');
    }
}