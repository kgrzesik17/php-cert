<?php
    include "partials/header.php";
    include "partials/navigation.php";

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

            $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
            $result = mysqli_query($conn, $sql);

            // check if username already exists
            if(mysqli_num_rows($result) === 1) {
                $error = "Username already exists, please choose another";
            } else {

                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hash', '$email')";

                // check if data was succesfully inserted
                if(mysqli_query($conn, $sql)) {
                    echo "DATA INSERTED";

                } else {
                    $error = "SOMETHING HAPPENED no data inserted, error: " . mysqli_error($conn);
                }
            }
        }
    }
?>
<div class="container">
    <h2>Register</h2>

    <?php if($error): ?>

        <p style="color: red;">
            <?php echo $error; ?>
        </p>

    <?php endif; ?>

    <form action="" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required><br><br>

        <label for="confirm_password">Confirm password:</label><br>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <input type="submit" value="Register">
    </form>
</div>

<?php
    include "partials/footer.php";
    mysqli_close($conn);
?>