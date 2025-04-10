<?php
$page_title = "Register page";

include 'partials/header.php';

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User(); 

    $user->register($username, $password);
}
?>

<h1>Register page</h1>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" name="username" id="username"><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password"><br><br>

    <input type="submit" value="Register">
</form>

<?php
include 'partials/footer.php';
?>
