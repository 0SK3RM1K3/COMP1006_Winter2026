<?php

//connect to database
require 'includes/connect.php';

//get ID from url
$playerId = $_GET['id'];

// create the query 
$sql = "DELETE from players WHERE player_id = :player_id";

//prepare 
$stmt = $pdo->prepare($sql);

//bind 
$stmt->bindParam(':player_id', $playerId);

//execute
$stmt->execute();

// Redirect back to teamList.php 
header("Location: teamList.php"); 
exit;
