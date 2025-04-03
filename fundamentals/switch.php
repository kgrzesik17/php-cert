<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    $day = "tuesday";
    $message = "Today is ";

    switch ($day) {
      case "monday":
        echo "$message $day";
        break;
      case "tuesday":
        echo "$message $day";
        break;
      default:
        echo 'Invalid day';
        break;
    }
  ?>
</body>
</html>