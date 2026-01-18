<?php
declare(strict_types=1);//no nonsense coding
require "connect.php";//including connect to database file
require "car.php";//including class car file that we built 
require "header.php"; 
echo "<p> Follow the instructions outlined in instructions.txt to complete this lab. Good luck & have fun!😀 </p>";

$car1 = new Car("Ford", "Taurus", 1990);

echo $car1->carInfo();

require "footer.php"; 

//I found the first part easy creating the class, very little refering back to lesson. mostly just to make sure syntax was correct.
//I found the second part, connecting to the database a little more difficult. I dont fully understand the meaning behind the PDO function commands
// so I will do some more studying to make sure i understand them better.