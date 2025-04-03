<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    if(!empty($username) && !empty($password)) {
      echo "Name: $username<br>";
      echo "Password: $password<br>";
    } else {
      echo "Fill in all the fields!<br>";
    }
  }
?>