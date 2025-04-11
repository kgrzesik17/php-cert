<?php
include 'init.php';

$_SESSION = null;
session_destroy();
redirect('index.php');