<!DOCTYPE html>
<html>
<head>
    <title>PHP OOP Example</title>
</head>
<body>

<?php

// Defining a class
class Car {
    // Properties
    public $color;
    public $model;

    // Constructor to initialize properties
    public function __construct($color, $model) {
        $this->color = $color;
        $this->model = $model;
    }

    // Method to return a message
    public function getDescription() {
        return "My car is a " . $this->color . " " . $this->model . ".";
    }
}

// Creating multiple car objects
$car1 = new Car("red", "Volvo");
$car2 = new Car("black", "BMW");

// Outputting messages
echo "<h2>Car Descriptions:</h2>";
echo $car1->getDescription() . "<br>";
echo $car2->getDescription() . "<br>";

?>

</body>
</html>
