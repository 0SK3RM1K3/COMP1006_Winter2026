<?php

require "includes/header.php";
require "includes/connect.php";

//check for id in url
if (!isset($_GET['id'])) {
  die("No player ID provided.");
}

$playerId = $_GET['id'];

/*only run if post is used*/
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}else{

    /*Sanitize input*/
    $firstName = trim(filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $lastName  = trim(filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS));
    $phone     = trim(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS));
    $email     = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $position = trim(filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS));
    $teamName = trim(filter_input(INPUT_POST, 'team_name', FILTER_SANITIZE_SPECIAL_CHARS));

    /*Server Side Validation*/
    $errors = [];

    // Required fields
    if ($firstName === null || $firstName === '') {
        $errors[] = "First Name is required.";
    }

    if ($lastName === null || $lastName === '') {
        $errors[] = "Last Name is required.";
    }

    if ($teamName === null || $teamName === '') {
        $errors[] = "Team Name is required.";
    }

    if ($position === null || $position === '') {
        $errors[] = "Position is required.";
    }

    // Phone: required + simple regex format check
    if ($phone === null || $phone === '') {
        $errors[] = "Phone number is required.";
    } elseif (!filter_var($phone, FILTER_VALIDATE_REGEXP, [
        'options' => ['regexp' => '/^[0-9\-\+\(\)\s]{7,25}$/']
    ])) {
        $errors[] = "Phone number format is invalid.";
    }

    // Email: required + format check
    if ($email === null || $email === '') {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email address.";
    }

    // If there are errors, show them and stop the script before inserting to the DB
    if (!empty($errors)) {
        require "includes/header.php";   // typically outputs DOCTYPE/head/nav/opening body tags
        echo "<div class='alert alert-danger'>";
        echo "<h2>Please fix the following:</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            // htmlspecialchars() prevents any unexpected HTML from being rendered
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
        echo "</div>";

        require "includes/footer.php";
        exit;
    }

    //make sql query
    $sql = "
        INSERT INTO players (
            first_name,
            last_name,
            phone,
            email,
            position,
            team_name
        ) VALUES (
            :first_name,
            :last_name,
            :phone,
            :email,
            :position,
            :team_name)";

    //prepare statement
    $stmt = $pdo->prepare($sql);

    //bind parameters
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':team_name', $teamName);

    //execute statement
    $stmt->execute();

    header("Location: orders.php");
        exit;
}



