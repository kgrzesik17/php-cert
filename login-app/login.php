<?php
    include "partials/header.php";
    include "partials/navigation.php";

    if(is_user_logged_in()) {
        redirect("admin.php");
        exit;
    }

    $error = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        // check if user with such username exists
        if(mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            // check if password hashes match
            if(password_verify($password, $user['password'])) {
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $user['username'];
                header("Location: admin.php");
                exit;
            } else {
                $error = "Invalid password";
            }

        } else {
            $error = "Invalid username";
        }
    }

?>
<div class="container">
    <div class="form-container">
        <form action="" method="POST">
            <h2>Login</h2>
            <?php if($error): ?>
                <p style="color: red;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

            <label for="username">Username</label><br>
            <input type="text" name="username" required><br><br>


            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br><br>


            <input type="submit" value="Login">
        </form>
    </div>
</div>

<?php
    include "partials/footer.php";
    mysqli_close($conn);
?>