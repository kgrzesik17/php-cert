<?php
include "partials/header.php";
include "partials/navigation.php";

if(!is_user_logged_in()) {
    redirect("login.php");
}

$result = mysqli_query($conn, "SELECT id, username, email, reg_date FROM users");

if($_SERVER['REQUEST_METHOD'] === "POST") {
    if(isset($_POST['edit_user'])) {
        echo "EDIT CLICKED";
    }
}
?>

<nav>
    <ul>
        <li>
            <a href="index.html">Home</a>
        </li>

        <!-- When the user is logged in -->
        <li>
            <a href="admin.html">Admin</a>
        </li>
        <li>
            <a href="logout.html">Logout</a>
        </li>

        <!-- When the user is not logged in -->
        <li>
            <a href="register.html">Register</a>
        </li>
        <li>
            <a href="login.html">Login</a>
        </li>
    </ul>
</nav>

<h1>Manage Users</h1>

<div class="container">
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php while ($user = mysqli_fetch_assoc($result)): ?>
            
        <tr>
            <td><?php echo $user['id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><?php echo full_month_date($user['reg_date']); ?>
            </td>
            <td>
                <form method="PO ST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <input type="email" name="email" value="<?php echo $user['email'] ?>" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>

        <?php endwhile; ?>

        </tr>
        <!-- Additional user rows can go here -->
        </tbody>
    </table>
</div>

<?php
    include "partials/footer.php";
?>