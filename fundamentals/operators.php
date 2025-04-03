<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<?php
  
  $a = 1;
  $b = 2;

  if ($a < $b) {
    print ("$a is greater than $b");
  }

  print "<br>";

  $a < $b ? print ("$a is greater than $b") : print ("it's not");

  print "<br>";

  // null coalescing

  $username = $_GET["user"] ?? "anononymous";
  print $username;

  print "<br>";

  $user = ['name' => 'Kacper Grzesik'];

  $age = $user['age'] ?? 'unknown';

  echo "Age: " . $age;
?>

</body>
</html>