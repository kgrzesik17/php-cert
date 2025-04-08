<?php

class User {
    public $name = "Edwin Diaz";  // can be accessed from anywhere
    protected $email = "edwin@gmail.com";  // can be accessed within (methods) the class and subclasses (children classes)
    private $password = "secret123";  // can be accessed within the class

    public function displayEmail()
    {
        return $this->email;
    }

    public function displayPassword()
    {
        return $this->password;
    }
}

class AdminUser extends User {
    public function getEmailAgain()
    {
        return $this->email . " FROM ADMIN CLASS";
    }

    public function displayFromAdmin()
    {
        return $this->password . " FROM ADMIN CLASS";
    }
}

// $user = new User();
// echo $user->displayPassword;

// $admin = new AdminUser();
// echo $admin->getEmailAgain();

$admin = new AdminUser();
echo $admin->displayFromAdmin();