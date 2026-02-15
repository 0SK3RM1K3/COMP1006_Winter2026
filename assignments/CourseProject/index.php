<?php require "includes/header.php" ?>

    <main>
        <h2>Team Member Information</h2>
        <form action="process.php" method="post">

            <!-- Team Member Information -->
            <fieldset>
            <legend>New To the leage? Enter Info Here:</legend>
                <label for="first_name" class="form-label">First name</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
                <label for="last_name" class="form-label">Last name</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
                <label for="phone" class="form-label">Phone number</label>
                <input type="tel" id="phone" name="phone" placeholder="555-123-4567" class="form-control" required>
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
                <label for="position" class="form-label">Position(LW,C,RW,LD,RD)</label>
                <input type="text" id="position" name="position" class="form-control" required>
                <label for="team_name" class="form-label">Team Name</label>
                <input type="text" id="team_name" name="team_name" class="form-control" required>
            </fieldset>

            <p>
            <button type="submit" class="btn btn-primary">Place Order</button>
            </p>

        </form>
    </main>
</body>

<?php require "includes/footer.php" ?>

</html>


