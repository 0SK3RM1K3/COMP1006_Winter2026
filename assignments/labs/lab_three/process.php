<?php 
require "includes/header.php";
//get the data, clean and store
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_SPECIAL_CHARS); 
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
//errors array
$errors = [];
//email variables
$to = "info@bakery.com";
$subject = "Contact Info";
$message = "Name: " . $firstName . " " . $lastName . " | Email: " . $email;

//server side validation of fields
if ($firstName === null || $firstName === '') {
    $errors[] = "First Name is Required."; 
}

if ($lastName === null || $lastName === '') {
    $errors[] = "Last Name is Required."; 
}

if ($email === null || $email === '') {
    $errors[] = "Email is Required"; 
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email must be a valid email"; 
}

//display errors and exit script
if(!empty($errors)) {
foreach ($errors as $error) : ?>
    <li><?php echo $error; ?> </li>
<?php endforeach;
//stop the script  
exit; 
}

?>

<main>
    <!-- echo friendly response -->
    <?php echo "<h2> Thanks for your info " . $firstName . "</h2>"; ?>
</main>

<?php mail($to, $subject, $message); ?>

<?php require "includes/footer.php"; ?>