<?php

function base_url($path = "") {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== "off" ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $folder = "php_tutorial"; // ENTER FOLDER NAME WITHIN HTDOCS

    $baseUrl = $protocol . $host . '/' . $folder . '/' . PROJECT_DIR;

    return $baseUrl . '/' . ltrim($path, '/');
}

function base_path($path = "") {
    $rootPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . PROJECT_DIR;

    return $rootPath . DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR);
}

function uploads_path($filename = '') {
    return base_path('upload') . DIRECTORY_SEPARATOR . $filename;
}

function uploads_url($filename = '') {
    return base_path('uploads' . '/' . ltrim($filename, '/'));
}

function asset_url($path = '') {
    return base_url('assets' . '/' . ltrim($path, '/'));
}

// redirects to given page
function redirect($url) {
    header("Location: " . base_url($url));
    exit;
}

// checks if post request has been sent
function isPostRequest() {
    return $_SERVER['REQUEST_METHOD'] === "POST";
}

// checks and trims POST data
function getPostData($field, $default = null) {
    return isset($_POST[$field]) ? trim($_POST[$field]) : $default;
}