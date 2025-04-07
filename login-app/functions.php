<?php
function is_user_logged_in() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function redirect($location) {
    header("Location: $location");
    exit;
}

function set_active_class($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $page_name) ? "active" : "";
}

function get_page_class() {
    return basename($_SERVER['PHP_SELF'], ".php");
}

function full_month_date($date) {
    return date("F j", strtotime($date));
}
?>