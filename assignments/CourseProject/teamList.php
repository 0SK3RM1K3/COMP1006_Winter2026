<?php

require "includes/header.php";
require "includes/connect.php";

// Get all players (sort by teams)
$sql = "SELECT * FROM players ORDER BY team_name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$players = $stmt->fetchAll();
?>

<!-- Build the table -->
<main class="mt-4">
    <h2>Player Information</h2>

    <?php if (empty($players)): ?>
        <p>No players yet.</p>
    <?php else: ?>

        <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th>Player ID</th>
                <th>Player Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Position</th>
                <th>Team Name</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($players as $player): ?>

                <tr>
                <td><?= htmlspecialchars($player['player_id']); ?></td>

                <td>
                    <?= htmlspecialchars($player['first_name']); ?>
                    <?= htmlspecialchars($player['last_name']); ?>
                </td>

                <td><?= htmlspecialchars($player['phone']); ?></td>
                <td><?= htmlspecialchars($player['email']); ?></td>
                <td><?= htmlspecialchars($player['position']); ?></td>
                <td><?= htmlspecialchars($player['team_name']); ?></td>

                <td>
                    <!-- Sends the ID to update.php -->
                    <a
                    class="btn btn-sm btn-warning"
                    href="update.php?id=<?= urlencode($player['player_id']); ?>">
                    Update
                    </a>
                    <a
                    class="btn btn-sm btn-danger mt-2"
                    href="delete.php?id=<?= urlencode($player['player_id']); ?>"
                    onclick="return confirm('Are you sure you want to delete this player?');">
                    Delete
                    </a>
                </td>
                </tr>

            <?php endforeach; ?>
            </tbody>
        </table>
        </div>

    <?php endif; ?>
    <a class="btn btn-secondary" href="index.php">Back to New Player</a>
</main>
</body>

<?php require "includes/footer.php"; ?>
