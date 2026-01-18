<?php
declare(strict_types=1);//no nonsense coding

class Car {
    //variables for class
    public string $make;
    public string $model;
    public int $year;

    //constructor
    public function __construct(string $make, string $model, int $year)
    {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    //method to return car info
    public function carInfo(): string {
        return "Make: {$this->make} Model: {$this->model} Year: {$this->year}";
    }
}