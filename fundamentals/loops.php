<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    echo 'For loop:<br>';

    for ($i = 0; $i < 10; $i++) {
      echo "Number: $i\n<br>";
    }

    echo "<br>";

    echo('While loop:<br>');

    $index = 0;
    
    while ($i < 10) {
      echo "Number: $i\n<br>";
      $index++;
    }

    echo "<br>";

    echo('Do while loop:<br>');

    $j = 50;

    // do first executes, then checks the condition
    do {
      echo "Number: $j\n<br>";
      $j++;
    } while ($j < 10);

    echo "<br>";

    // foreach

    print "Foreach loop:<br>";

    $colors = ['red', 'blue', 'yellow', 'green'];
    $person = ["name" => "Edwin", "age" => 23];

    foreach($colors as $color) {
      echo "Color: $color<br>";
    }

    echo "<br>";

    foreach($person as $key => $value) {
      echo "$key: $value<br>";
    }

    echo "<br>";

    // break

    print "Break:<br>";

    for($i = 1; $i <= 5; $i++) {
      if ($i == 3) {
        break;
      }

      echo $i, '<br>';
    }

    echo "<br>";

    // continue

    echo "Continue:<br>";

    for($i = 1; $i <= 5; $i++) {
      if ($i == 3) {
        continue;
      }

      echo $i, '<br>';
    }
  ?>
</body>
</html>