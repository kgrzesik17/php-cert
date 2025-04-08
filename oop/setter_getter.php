<?php

class User {
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->setEmail($email);
        // $this->name = $name;
        // $this->email = $email;
    }

    // getter
    public function getEmail()
    {
        return $this->email;
    }

    // setter
    public function setEmail($email)
    {
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $this->email = $email;
        } else {
            echo "Not a valid email";
        }
    }

    public function displayUserInfo()
    {
        return "User: " . $this->getEmail();
    }

}

$user = new User('Edwin Diaz', 'edwin@gmail.com');

$user->setEmail('edwin_updated@gmail.com');

echo $user->displayUserInfo() . "<br>";

$user->setEmail('edwin_updated_AGAIN@gmail.com');

echo $user->displayUserInfo();