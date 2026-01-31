<?php require "includes/header.php" ?>
<main>
    <form action="process.php" method="post">
        
        <legend>Customer Information</legend>
        
        <label for="first_name">First name</label>
        <input type="text" id="first_name" name="first_name">
        
        <label for="last_name">Last name</label>
        <input type="text" id="last_name" name="last_name">
        
        <label for="email">Email</label>
        <input type="email" id="email" name="email">
        
        <label for="message">Message (optional)</label><br>
        <textarea id="message" name="message" rows="4"
          placeholder="Any Additional Information"></textarea>
    </form>
</main>
<?php require "includes/footer.php" ?>