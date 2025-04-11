<?php 
$html_title = "";

include 'partials/header.php';

$user = new User();
$article = new Article();

$article_data = $article->get_all();

if(is_user_logged_in()) {
    $user_info = $user->get_info_by_id($_SESSION['user_id']); 
} 

if($_SERVER['REQUEST_METHOD'] === "POST") {
    $delete_id = $_POST['delete'];
   
    if($article->delete($delete_id)) {
        redirect('index.php');
        exit;
    } else {
        echo "Failed to delete";
    }
}
?>

<h1>Hello <?php echo is_user_logged_in() ? $user_info->username : "" ?></h1>

<div>
    <ul>
        <?php if(is_user_logged_in()): ?>
            <li><a href="create_article.php">Create</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</div>


<div>
    <table>
        <tr>
            <th>Author</th>
            <th>Title</th>
            <th>Content</th>
            <th>Creation date</th>
            <th>Page</th>
            <th>Manage</th>
        </tr>

        <?php foreach($article_data as $single_article): ?>
            <tr>
                <td><?php echo $single_article->author_name; ?></td>
                <td><?php echo $single_article->title; ?></td>
                <td><?php echo $single_article->content; ?></td>
                <td><?php echo $single_article->created_date; ?></td>
                <td><a href="article.php?id=<?php echo $single_article->id; ?>">Enter</a></td>
                <td>
                    <form action="" method="POST">
                        <input name="delete" type="hidden" value="<?php echo $single_article->id ?>">

                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>
</div>


<?php 
include 'partials/footer.php';
?>