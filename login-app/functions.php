<?php

function set_active_class($page_name) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return ($current_page === $page_name) ? "active" : "";
}

function get_page_class() {
    return basename($_SERVER['PHP_SELF'], ".php");
}

?>