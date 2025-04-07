<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "login_app";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Connected";
}

function check_query($result) {
    global $conn;  // not the best practice, but now it's too dangerous to remove!!!

    if(!$result) {
        return "Error: " . mysqli_error($conn);
    }
    
    return true;
}

function user_exists($conn, $username) {
    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    return mysqli_num_rows($result) > 0;
}

function create_user($conn, $username, $email, $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$password_hash', '$email')";

    return mysqli_query($conn, $sql);
}

function update_user($conn, $user_id, $new_username, $new_email) {
    $sql = "UPDATE users SET email = '$new_email', username = '$new_username' WHERE id = $user_id";
    
    return mysqli_query($conn, $sql);
}

function delete_user($conn, $user_id) {
    $sql = "DELETE FROM users WHERE id = $user_id";

    return mysqli_query($conn, $sql);    
}

?>