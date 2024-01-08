<?php

class Car
{
    public string $name;

    //Add a name parameter to constructor
    function __construct($name)
    {
        $this->name = $name;
    }

    function get_name(): string
    {
        return $this->name;
    }

//    function print_assembly() {
//        echo "The Tesla Car finishes assembly every Friday at 5pm.";
//    }
}

class TeslaCar extends Car
{
    function generate_assembly_reports(): void
    {
        echo "Generating assembly reports...";
        echo "Exporting CSV format reports...";
        echo "Printing reports...";
    }

    // This Method is more related to TeslaCar So we can define it in TeslaCar Class
    function print_assembly(): void
    {
        echo "The Tesla Car finishes assembly every Friday at 5pm.";
    }
}

$car = new TeslaCar("Model_3");
echo $car->get_name();
echo "<br>";
$car->generate_assembly_reports();

?>
