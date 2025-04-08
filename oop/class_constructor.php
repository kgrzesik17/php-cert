<?php

class User {

    public $username;

    public function __construct($username)
    {
        $this->username = $username;   
    }

    public function setUsername() {
        echo $this->username;
    }
}

$user = new User('edwin');

echo $user->username;