<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    function greetUserWithTime($name, $greeting = "Good Morning") {
      echo "{$greeting} {$name}\n";
    }

      greetUserWithTime("Alice");
      echo "<br>";
      greetUserWithTime(greeting: "Hello ", name: "Bob");
  ?>
</body>
</html>