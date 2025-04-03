<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php

  // type casting 

  $a = 5;
  $b = (string) 5;

  var_dump($a, $b);

  echo '<br>';

  $c = ["name" => "Kacper"];
  $d = (object) ["name" => "Kacper"];

  var_dump($c, $d);

  echo '<br>';

  // echo $c -> name; // DOESN'T WORK
  echo $d -> name;

  echo $c['name'];
  // echo $d['name']; // DOESN'T WORK

  ?>
</body>
</html>