<?php
require 'init.php';

if(isPostRequest()) {
    $article = new Article();

    if($article->generateDummyData()) {
        redirect('admin.php');
    } else {
        echo "Something bad happened";
    }
}