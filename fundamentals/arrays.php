<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php

    $fruits = ["apple", "banana", "orange"];

    // access elements in array
    echo $fruits[0];
    echo "<br>";

    // adding new elements
    $fruits[] = "mango";
    array_push($fruits, "orange");

    var_dump($fruits);
    echo "<br>";
    echo "<br>";

    // associative arrays
    $person = [
      "name" => "Kacper Grzesik",
      "age" => 22,
      "city" => "Wroclaw"
    ];

    $person['profession'] = 'music producer';

    foreach ($person as $key => $value) {
      echo "$key: $value<br>";
    }

    echo "<br>";

    // multi dimentional arrays
    $products = [
      ["name" => "Laptop", "price" => 1000, "stock" => 5],
      ["name" => "Mouse", "price" => 20, "stock" => 20],
      ["name" => "Keyboard", "price" => 40, "stock" => 30]
    ];

    echo $products[0]["name"];

    echo "<br>";
    echo "<br>";

    foreach($products as $product) {
      foreach($product as $val) {
        echo $val . " ";
      }
      echo "<br>";
    }
    
    echo "<br>";

    foreach($products as $product) {
      echo $product['name'] . ' costs ' . $product['price'] . '$.<br>';
    }

    echo "<br>";

    function calculateTotalPrice($products) {
      $total = 0;

      foreach($products as $product) {
        $total += $product['price'];
      }

      return $total;
    }

    echo "Total price is: $" . calculateTotalPrice($products) . ".";
  ?>
</body>
</html>