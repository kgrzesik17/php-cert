<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    function greet () {
      echo "Hello, welcome to PHP!";
    }

    greet();
    echo "<br>";

    function calculateRectangleArea($length, $width) {
      echo $length * $width;
    }

    calculateRectangleArea(2, 3);

    echo "<br>";

    function calculateSum($a, $b) {
      return $a + $b;
    }

    $sum = calculateSum(2, 4);

    echo "The sum is: $sum";

  ?>
</body>
</html>