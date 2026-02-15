<?php

require "includes/header.php";
require "includes/connect.php";

//check for id in url
if (!isset($_GET['id'])) {
  die("No player ID provided.");
}

$playerId = $_GET['id'];

/*only run if post is used*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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
    $sql = "UPDATE players SET
        first_name = :first_name,
        last_name = :last_name,
        phone = :phone,
        email = :email,
        position = :position,
        team_name = :team_name
    WHERE player_id = :player_id";

    //prepare statement
    $stmt = $pdo->prepare($sql);

    //bind parameters
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':position', $position);
    $stmt->bindParam(':team_name', $teamName);
    $stmt->bindParam(':player_id', $playerId);

    //execute statement
    $stmt->execute();

    header("Location: orders.php");
        exit;
}

//load existing data into form to be adjusted
$sql = "SELECT * FROM players WHERE player_id = :player_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':player_id', $playerId);
$stmt->execute();

$player = $stmt->fetch();

if (!$player) {
  die("Player not found.");
}
?>

<main class="container mt-4">
  <h2>Update Player ID # <?= htmlspecialchars($player['player_id']); ?></h2>

  <?php if (!empty($error)): ?>
    <p class="text-danger"><?= htmlspecialchars($error); ?></p>
  <?php endif; ?>

  <form method="post">

    <h4 class="mt-3">Player Information</h4>

    <label class="form-label">First Name</label>
    <input
      type="text"
      name="first_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($player['first_name']); ?>"
      required
    >

    <label class="form-label">Last Name</label>
    <input
      type="text"
      name="last_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($player['last_name']); ?>"
      required
    >

    <label class="form-label">Phone</label>
    <input
      type="tel"
      name="phone"
      class="form-control mb-3"
      value="<?= htmlspecialchars($player['phone']); ?>"
      required
    >

    <label class="form-label">Email</label>
    <input
      type="email"
      name="email"
      class="form-control mb-4"
      value="<?= htmlspecialchars($player['email']); ?>"
      required
    >

    <label class="form-label">Position</label>
    <input
      type="text"
      name="position"
      class="form-control mb-3"
      value="<?= htmlspecialchars($player['position']); ?>"
      required
    >

    <label class="form-label">Team Name</label>
    <input
      type="text"
      name="team_name"
      class="form-control mb-3"
      value="<?= htmlspecialchars($player['team_name']); ?>"
      required
    >

    <button class="btn btn-primary">Save Changes</button>
    <a href="teamList.php" class="btn btn-secondary">Cancel</a>

  </form>
</main>

<?php require "includes/footer.php"; ?>

</body>

</html>

