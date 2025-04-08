<?php

class User {

    public function create()
    {
        return "creating user";
    }
}

$user = new User();
$admin = new User();

echo $user->create();