<?php

function redirect($url) {
    return header("Location: $url");
}

function is_user_logged_in() {
    if(isset($_SESSION['is_logged_in'])) {
        return true;
    } else {
        return false;
    }
}