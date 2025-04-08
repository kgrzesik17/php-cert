<?php
include 'db.php';

$stmt = mysqli_prepare($conn, "UPDATE users SET username = ? WHERE id = ?");

if($stmt) {
    $user_id = 7;
    $username = "Edwin Diaz - UPDATED";

    mysqli_stmt_bind_param($stmt, "si", $username, $user_id);

    mysqli_stmt_execute($stmt);

    echo "Updated successfully";

    mysqli_stmt_close($stmt);
    
} else {
    echo "Error: " . mysqli_error($conn);
}