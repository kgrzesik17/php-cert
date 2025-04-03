<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=	, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    
    echo 27 % 4;

    function isEven($number) {
      if ($number % 2 == 0) {
        return true;
      } else {
        return false;
      }
    }

    echo "<br>";

    echo var_dump(isEven(2)); // var_dump is needed, because bool: false isn't displayed

    echo "<br>";

    $number = 10;

    echo "$number is an " . (isEven($number) ? 'even' : 'odd') . " number.";
  ?>
</body>
</html>