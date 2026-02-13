<?php
require "includes/header.php";
require "includes/connect.php";

?>

<main class="container mt-4">
  <h2>Orders</h2>

  <?php if (count($orders) === 0): ?>
    <p>No orders yet.</p>
  <?php else: ?>
    <ul>

    </ul>
    
  <?php endif; ?>

  <p class="mt-3">
    <a href="index.php">Back to Order Form</a>
  </p>
</main>

<<<<<<< HEAD
<?php require "includes/footer.php"; ?>
=======
<?php require "includes/footer.php"; ?>
>>>>>>> 1a34152f2636dd2ad897ed74d8dd6a77e49b6821
