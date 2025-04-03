<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php

    $app = "PHP CMS";
    $app2 = "PHP and MySQL";
    
    function exampleFunction() {
      echo $GLOBALS['app'];
      echo "<br>";
      echo $GLOBALS['app2'];

    }

    exampleFunction();

    echo "<br>";
    echo "<br>";

    // print_r($GLOBALS);


    // doesn't work on liveserver for some reason
    $name = $_GET['name'];
    $age = $_GET['age'];

    echo "Name: " . $name . "<br>"; 
    echo "Age: " . $age . "<br>"; 

    echo "<br>";

    echo $_SERVER['SERVER_ADMIN'];
    echo "<br>";
    echo $_SERVER['HTTP_USER_AGENT'];

  ?>
</body>
</html>