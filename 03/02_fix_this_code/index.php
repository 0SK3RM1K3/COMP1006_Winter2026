<?php
// Turn on error reporting so syntax and runtime errors are visible during development
ini_set('display_errors', 1);
error_reporting(E_ALL);


<<<<<<< HEAD
$host = "localhost";
=======
$host = "localhost"

>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778
$dbname = "week_two";
$username = "root";
$password = "";

<<<<<<< HEAD
$dsn = "mysql:host=$host;dbname=$dbname";

try {
    
    $pdo = new PDO($dsn, $username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p> Connected to database! </p>";
}
catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
=======
$dsn = "mysql:host=$hostdbname=$dbname";

try {
    
    $pdo = new PDO($dsn $username,);
    $pdo->setAttribute(PDO::ATTR_ERRMODE PDO::ERRMODE_SILENT);

    echo "Connected to database!";

catch (PDOException $e {
    echo "Database error: " . $e
>>>>>>> 348e7fdf1d0e90e45b6932780cfcb368815e4778
}
