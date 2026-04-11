<?php

require "includes/auth.php";

$_SESSION = [];

session_unset();

// Destroy session
session_destroy();

header("Location: login.php");

exit;