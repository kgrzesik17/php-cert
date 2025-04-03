<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php

    // math

    echo abs(-10);
    echo "<br>";
    
    echo round(3.567, 2);
    echo "<br>";

    echo ceil(4.2) . ', ' . floor(4.2);
    echo "<br>";

    $numbers = [1, 20, 30, 40, 55, 50];

    echo max($numbers) . ', ' . min($numbers);
    echo "<br>";

    $base = 2;
    $exp = 3;

    echo pow($base, $exp) . ', ' . $base ** $exp;
    echo "<br>";

    echo sqrt(3);
    echo "<br>";

    echo rand(0, 100);

    echo "<br>";
    echo "<br>";

    // string
    
    $str = "Hello, world!";

    echo strlen($str);
    echo "<br>";

    echo strtoupper($str);
    echo "<br>";
    
    echo strtolower($str);
    echo "<br>";

    $position = strpos($str, "world");

    if ($position) {
      echo $position;
    }

    echo "<br>";

    $new_str = str_replace("world", "student", $str);

    echo $new_str;

    echo "<br>";
    echo "<br>";

    // array functions

    $fruits = ["Apple", "Banana", "Orange"];
    $veggies = ["Carrot", "Lettuce", "Onion"];
    
    print_r($fruits);
    echo "<br>";

    echo count($fruits);
    echo "<br>";

    array_push($fruits, "Pineapple");
    print_r($fruits);
    echo "<br>";

    array_pop($fruits);
    print_r($fruits);
    echo "<br>";

    $food = array_merge($fruits, $veggies);
    print_r($food);
    echo "<br>";

    if(in_array("Banana", $fruits)) {
      echo 'Banana is in the array.';
    } else {
      echo 'Banana is not in the array';
    }

    echo "<br>";

    $numbers = [1, 3, 6, 2, 6453, 12, 4, 77];

    sort($numbers);
    print_r($numbers);
    echo "<br>";

    $person = ["name" => "Kacper Grzesik", "age" => "22", "city" => "Wroclaw"];
    ksort($person); // sort by key
    print_r($person);
    echo "<br>";  
    echo "<br>";

    $fruits1 = ["Pomegrenade", "Pear", "Pineapple"];
    print_r($fruits1);
    echo "<br>";

    $sliced = array_slice($fruits1, 1, 2);
    print_r($sliced);
  ?>
</body>
</html>