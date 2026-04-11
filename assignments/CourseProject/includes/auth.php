<?php
// check or start session
session_start();

// Prevent caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");


// check session to see whether user is logged in

if (empty($_SESSION["user_id"])) {
    header('Location:restricted.php');
    exit();
} 