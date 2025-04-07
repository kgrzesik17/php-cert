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
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        // check if passwords match
        if($password !== $confirm_password) {
            $error = "Passwords do not match";
        } else {

            // check if username already exists
            if(user_exists($conn, $username)) {
                $error = "Username already exists, please choose another";
            } else {

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hash', '$email')";

                if(check_query(create_user($conn, $username, $email, $password))) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['username'] = $username;
                    redirect("admin.php");
                    exit;
                } else {
                    $error = "SOMETHING HAPPENED no data inserted, error: " . mysqli_error($conn);
                }
            }
        }
    }
?>
<div class="container">
    <div class="form-container">
        <form action="" method="POST">
            <h2>Create your Account</h2>

            <?php if($error): ?>
                <p style="color: red;">
                    <?php echo $error; ?>
                </p>
            <?php endif; ?>

            <label for="username">Username:</label>
            <input type="text" value="<?php echo isset($username) ? $username : '' ?>" placeholder="Enter your username" name="username" id="username" required>

            <label for="email">Email:</label>
            <input type="email" value="<?php echo isset($email) ? $email : '' ?>" placeholder="Enter your email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" placeholder="Enter your password" name="password" id="password" required>

            <label for="confirm_password">Confirm password:</label>
            <input type="password" placeholder="Confirm your password" name="confirm_password" id="confirm_password" required>

            <input type="submit" value="Register">
        </form>
    </div>
</div>

<?php
    include "partials/footer.php";
    mysqli_close($conn);
?>