<?php
// Musawirullah Stanikzai - 1234

// Task 3
abstract class Vehicle {
    abstract public function start();
}

class Car extends Vehicle {
    public function start() {
        echo "Car engine started.";
    }
}

class Bike extends Vehicle {
    public function start() {
        echo "Bike started.";
    }
}

$c = new Car();
$b = new Bike();

$c->start();
echo "<br>";
$b->start();
?>
