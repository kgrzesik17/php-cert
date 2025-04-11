<?php

function render($view, $data = [], $layout = 'layout') {

    extract($data);  // extract variables

    ob_start();  // start output buffering

    require __DIR__ . '/views/' . $view . '.php';

    $content = ob_get_clean();  // get content from output buffering

    require __DIR__ . "/views/" . $layout . ".php";

}