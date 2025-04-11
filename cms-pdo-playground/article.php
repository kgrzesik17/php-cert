<?php
include 'partials/header.php';
?>

<?php 
if(!isset($_GET['id'])) {
    redirect('index.php');
}

$id = $_GET['id'];
$article = new Article();

$article_data = $article->get_one_by_id($id);
?>

<a href="index.php">Go back</a>

<h1><?php echo $article_data->title; ?></h1>
<small>By: <?php echo $article_data->author_name; ?></small>

<article><?php echo $article_data->content; ?></article>

<?php
include 'partials/footer.php';
?>