<?php
require_once './init.php';
require_once './helpers.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($html_title) && strlen($html_title) > 1 ? $html_title : "CMS PDO Playground"; ?></title>

    <style>
        table {
            width: 50%;
        }

        td {
            height: 100px;
        }
        
        table, tr, th, td {
            border: 1px solid black;
            text-align: center;
        }
    </style>
</head>
<body>