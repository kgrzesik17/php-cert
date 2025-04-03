<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <?php
    $age = 18;
    $isMember = true;
    $hasDiscountCoupon = true;

    if ($age >= 18 && ($isMember || $hasDiscountCoupon)) {
      echo 'Is eglegible for the discount';
    } else {
      echo 'Is not';
    }

    print "<br>";

    echo $isMember ? "you're a member" : "you're not a member";

    echo "<br>";
    
    $test = $hasDiscountCoupon ? true : false;

    print $test;

  ?>
</body>
</html>