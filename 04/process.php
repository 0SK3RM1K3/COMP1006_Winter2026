<?php
require "includes/header.php"; 
//accessing the form data 

$firstName = $_POST['first_name'];
$lastName = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$comments = $_POST['comments']; 

//what about the products? 

$items = $_POST['items']; 

// ---------------------------------------------------------
// 4) Email configuration
// ---------------------------------------------------------
$to = "bitumi@gmail.com";
$subject = "New Bakery Order Submission";

// ---------------------------------------------------------
// 5) Build the email message
// ---------------------------------------------------------
// Email content is just a STRING.
$message  = "NEW BAKERY ORDER\n";
$message .= "=========================\n";
$message .= "Customer: {$firstName} {$lastName}\n";
$message .= "Phone: {$phone}\n";
$message .= "Address: {$address}\n\n";

$message .= "Items Ordered:\n";

/* =========================================================
   ASSOCIATIVE ARRAYS + FOREACH LOOP (Instructor Notes)
   ---------------------------------------------------------
   $items is an associative array:
     - KEY   → product name (e.g., chaos_croissant)
     - VALUE → quantity (e.g., 2)

   foreach loops are used to loop through arrays.

   Syntax:
     foreach ($array as $key => $value) {
         // code
     }
   ========================================================= */
foreach ($items as $item => $quantity) {
    $message .= "- {$item}: {$quantity}\n";
}

$message .= "\nAdditional Comments:\n";
$message .= ($comments === "") ? "(none)\n" : "{$comments}\n";

// ---------------------------------------------------------
// 6) Send the email
// ---------------------------------------------------------
// NOTE:
// mail() may not work on local machines without configuration.
// That’s okay — the confirmation page will still display.
$headers = "From: no-reply@bakeittillyoumakeit.example\r\n";
mail($to, $subject, $message, $headers);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmation</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

  <main>
    <h1>Thank You for Your Order! 🧁</h1>

    <p>
      Thanks <strong><?= $firstName ?></strong>!
      Your order has been received and sent to the bakery.
    </p>

    <h2>Your Order Details</h2>

    <p><strong>Name:</strong> <?= $firstName ?> <?= $lastName ?></p>
    <p><strong>Phone:</strong> <?= $phone ?></p>
    <p><strong>Address:</strong> <?= $address ?></p>

    <h3>Items Ordered</h3>
    <ul>
      <?php foreach ($items as $item => $quantity): ?>
        <li><?= $item ?> — <?= $quantity ?></li>
      <?php endforeach; ?>
    </ul>

    <h3>Additional Comments</h3>
    <p><?= $comments === "" ? "(none)" : $comments ?></p>

    <p>
      A confirmation has been sent to the bakery.
    </p>

      <a href="index.html">Place another order</a>
      </main>

<?php require "includes/footer.php"; ?> 