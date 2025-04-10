<?php 
require_once "init.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) && strlen($page_title) > 0 ? $page_title : "CMS System"; ?></title>
</head>
<body>
