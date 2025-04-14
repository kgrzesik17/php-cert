<?php

class AdminController {
    public function __construct()
    {
        
    }

    public function dashboard() {
        $data = [
            'title' => 'Admin Page',
            'message' => 'Welcome to the Dashboard'
        ];

        render('admin/dashboard', $data, 'layouts/admin_layout');
    }
}