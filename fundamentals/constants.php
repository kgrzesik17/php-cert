<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    // creating a constant
    define("DB_PASS", "secret123");
    const DB_LOGIN = "kacper";

    echo DB_PASS;
    echo DB_LOGIN;

    echo '<br>';


    // magic constants

    echo __DIR__ . '<br>';
    echo __FILE__ . '<br>';
    echo __LINE__ . '<br>';
    ?>
</body>
</html>