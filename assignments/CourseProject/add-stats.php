<?php
require "includes/auth.php";

require "includes/connect.php";

require "includes/adminHeader.php";

$errors = [];

$success = "";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get and sanitize form values
    $name = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $quote = trim(filter_input(INPUT_POST, 'quote', FILTER_SANITIZE_SPECIAL_CHARS));
    $goals = filter_input(INPUT_POST, 'goals', FILTER_VALIDATE_INT);
    $assists = filter_input(INPUT_POST, 'assists', FILTER_VALIDATE_INT);
    $pm = filter_input(INPUT_POST, 'pm', FILTER_VALIDATE_INT);

    // store image path for the database
    $imagePath = null;

    // Validate player name
    if ($name === '') {
        $errors[] = "Player name is required.";
    }

    // Validate quote
    if ($quote === '') {
        $errors[] = "Favorite Quote is required.";
    }

    // Validate goals
    if ($goals === false || $goals < 0) {
        $errors[] = "Goals must be a valid number.";
    }

    // Validate assists
    if ($assists === false || $assists < 0) {
        $errors[] = "Assists must be a valid number.";
    }

    // Validate penalty minutes
    if ($pm === false || $pm < 0) {
        $errors[] = "Penalty Minutes must be a valid number.";
    }
     
    //check wheather a file was uploaded

    if(isset($_FILES['player_image']) && $_FILES['player_image']['error'] !== UPLOAD_ERR_NO_FILE) {

        //make sure upload completed succefully
        if($_FILES['player_image']['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "There was a problem uploading your file!";
        }
        else {
            //only allow a few file types
            $allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/jpg'];

            //detect the real MIME type of file
            $detectedType = mime_content_type($_FILES['player_image']['tmp_name']);

            if(!in_array($detectedType, $allowedTypes, true)) {

                $errors[] = "Only JPG, PNG and WebP allowed!";

            }
            else {
                //get file extension
                $extension = pathinfo($_FILES['player_image']['name'], PATHINFO_EXTENSION);

                //creat a unique filename so uploaded files don't overwrite
                $safeFilename = uniqid('player_', true) . '.' . strtolower($extension);

                //build the full server path where file will be stored
                $destination = __DIR__ . '/uploads/' . $safeFilename;

                if(move_uploaded_file($_FILES['player_image']['tmp_name'], $destination)) {

                    //save the relative path to the database
                    $imagePath = 'uploads/' . $safeFilename;

                }
                else {
                    $errors[] = "Image upload failed!";
                }
            }
        }

    }



    // If there are no errors, insert the product into the database
    if (empty($errors)) {
        $sql = "INSERT INTO mugshots (name, quote, goals, assists, pm, image_path)
                VALUES (:name, :quote, :goals, :assists, :pm, :image_path)";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':quote', $quote);
        $stmt->bindParam(':goals', $goals);
        $stmt->bindParam(':assists', $assists);
        $stmt->bindParam(':pm', $pm);
        $stmt->bindParam(':image_path', $imagePath);
        $stmt->execute();

        $success = "Mugshot added successfully!";
    }
}
?>

<main class="container mt-4">
    <h1>Add Player Stats</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <h3>Please fix the following:</h3>
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success !== ""): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>
   
    <form method="post" enctype="multipart/form-data" class="mt-3">
        <label for="name" class="form-label">Player Name</label>
        <input
            type="text"
            id="name"
            name="name"
            class="form-control mb-3"
            required
        >

        <label for="quote" class="form-label">Favorite Quote</label>
        <textarea
            id="quote"
            name="quote"
            class="form-control mb-3"
            rows="4"
            required
        ></textarea>

        <label for="goals" class="form-label">Goals</label>
        <input
            type="number"
            id="goals"
            name="goals"
            class="form-control mb-3"
            step="1"
            min="0"
            required
        >

        <label for="assists" class="form-label">Assists</label>
        <input
            type="number"
            id="assists"
            name="assists"
            class="form-control mb-3"
            step="1"
            min="0"
            required
        >

        <label for="pm" class="form-label">Penalty Minutes</label>
        <input
            type="number"
            id="pm"
            name="pm"
            class="form-control mb-3"
            step="1"
            min="0"
            required
        >

        <label for="player_image" class="form-label">Player Image</label>
        <input
            type="file"
            id="player_image"
            name="player_image"
            class="form-control mb-4"
            accept=".jpg,.jpeg,.png,.webp"
        >

        <button type="submit" class="btn btn-primary">Add Player</button>
    </form>
</main>

<?php require "includes/footer.php"; ?>