<?php 
$html_title = "Register";

include 'partials/header.php';

$user = new User();

$error= "";

if($_SERVER['REQUEST_METHOD'] === "POST") {  // check if post was sent
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeat = $_POST['repeat'];

    if($password !== $repeat) {
        $error = "Error: Passwords must match";
    } else {
        $result = $user->register($username, $password);
    
        if(str_contains($result, "Error")) {
            $error = $result;
        } else {
            redirect('login.php');
        }
    }

}
?>

<h1>Register page</h1>

<p style="color: red;"><?php echo $error; ?></p>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="repeat">Repeat password:</label>
    <input type="password" id="repeat" name="repeat" required><br><br>

    <input type="submit" value="Register">
</form>

<?php 
include 'partials/footer.php';
?>