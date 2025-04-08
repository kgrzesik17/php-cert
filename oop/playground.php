<?php

class Engine {
    public $power;
    public $capacity;

    public function __construct($power, $capacity)
    {
        $this->power = $power;
        $this->capacity = $capacity;
    }

    public function getPower()
    {
        return $this->power;
    }
}

class Car extends Engine {
    public static $count = 0;
    public $make;
    public $model;

    public function __construct($make, $model, $power, $capacity)
    {
        parent::__construct($power, $capacity);
        $this->make = $make;
        $this->model = $model;
        Car::$count++;
    }

    public function displayInfo()
    {
        echo "Make: {$this->make}<br>";
        echo "Model: {$this->model}<br>";
        echo "Power: {$this->power} HP<br>";
        echo "Capacity: {$this->capacity}L<br><br>";
    }
}

$car = new Car("BMW", "E91", 231, 3.0);
$car1 = new Car("Toyota", "Corolla", 110, 1.6);
$car2 = new Car("Volkswagen", "Passat", 130, 1.9);
$car3 = new Car("Volkswagen", "Passat", 130, 1.9);

$engine = new Engine(100, 1.4);

$car->displayInfo();
$car1->displayInfo();
$car2->displayInfo();

echo $engine->power . "<br><br>";

echo "The car count is: " . Car::$count;