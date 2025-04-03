<?php
    session_start();

    $message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        // example credentials
        $username = 'kacper';
        $password = 'secret';

        // get the input from the user
        $input_username = $_POST["username"];
        $input_password = $_POST["password"];

        if($input_username === $username && $input_password === $password) {
            // set session variables

            $_SESSION["logged_in"] = true;
            $_SESSION["username"] = $input_username;

            header("Location: admin.php");
            exit;
        } else {
            $message = "Invalid username or password.";
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login Page</h2>

    <?php if ($message): ?>
        <p style="color: red;"><?php echo $message ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
        <br><br>
        <label for="username">Password</label>
        <input type="password" name="password" id="password">
        <br><br>

        <input type="submit" value="Login">
    </form>
</body>
</html>