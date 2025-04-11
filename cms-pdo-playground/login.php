<?php 
$html_title = "Login";

include 'partials/header.php';

$user = new User();

$error= "";

if($_SERVER['REQUEST_METHOD'] === "POST") {  // check if post was sent
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $user->login($username, $password);
    
        if(str_contains($result, "Error")) {
            $error = $result;
        } else {
            redirect('index.php');
        }
}
?>

<h1>Login page</h1>

<p style="color: red;"><?php echo $error; ?></p>

<form action="" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<?php 
include 'partials/footer.php';
?>