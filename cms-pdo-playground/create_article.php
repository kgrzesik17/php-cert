<?php
$html_title = "Create article";

include 'partials/header.php';

if(!is_user_logged_in()) {
    redirect('index.php');
}

$error = "";

$user = new User();
$article = new Article();

$user_info = $user->get_info_by_id($_SESSION['user_id']);

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if($article->create($title, $content, $user_info->id)) {
        redirect('index.php');
    } else {
        $error = "There was an error creating a new article";
    }
}
?>

<h1>Create article</h1>

<p style="color: red;"><?php echo $error; ?></p>

<a href="index.php">Go back</a><br><br>

<form action="" method="POST">
    <label for="title">Title:</label>
    <input type="text" id="title" name="title"><br><br>

    <label for="content">Content:</label>
    <textarea name="content" id="content" rows="15" cols="45"></textarea><br><br>
    <input type="submit" value="Add">
</form>

<?php
include 'partials/footer.php';
?>