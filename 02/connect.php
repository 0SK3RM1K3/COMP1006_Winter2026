<?php 
<<<<<<< HEAD
declare(strict_types=1);

$host = "localhost";//host name
$db = "week_two";//database name
$user = "root";//username
$password = "";//password
=======
declare(strict_types=1); 

$host = "localhost"; //hostname
$db = "week_two"; //database name
$user = "root"; //username
$password = ""; //password
>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778

//points to the database
$dsn = "mysql:host=$host;dbname=$db";

<<<<<<< HEAD
//try to connect, if connected echo good job!
try{
    $pdo = new PDO ($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "<p> Good Job! It worked! </p>";
}
//what happens if there is an error connecting
catch(Exception $e){
    die("Database connection failed: " . $e->getMessage());
}
=======
//try to connect, if connected echo a yay!
try {
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   echo "<p> YAY CONNECTED! </p>"; 
}
//what happens if there is an error connecting 
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}

>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778
