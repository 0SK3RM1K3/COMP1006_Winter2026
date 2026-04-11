<?php 
require "includes/connect.php";
require "includes/header.php";

// Get all player, sorted by name

$sql = "SELECT * FROM players ORDER BY name ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$players = $stmt->fetchALL(PDO::FETCH_ASSOC);

?>

<main class="container mt-4">
    <h1 class="mb-4">Leauge Stats</h1>
    <?php if (empty($players)): ?>
        <p>No players available yet.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($players as $player): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <?php if (!empty($player['image_path'])): ?>
                            <img
                                src="<?= htmlspecialchars($player['image_path']); ?>"
                                class="card-img-top"
                                alt="<?= htmlspecialchars($player['name']); ?>">
                        <?php endif; ?>

                        <div class="card-body">
                            <h2 class="h5 card-title">
                                <?= htmlspecialchars($player['name']); ?>
                            </h2>

                            <p class="card-text">
                                <?= nl2br(htmlspecialchars($player['quote'])); ?>
                            </p>

                            <p class="fw-bold">
                                Goals: <?= number_format((int)$player['goals'], 2); ?>
                            </p>

                            <p class="fw-bold">
                                Assists: <?= number_format((int)$player['assists'], 2); ?>
                            </p>

                            <p class="fw-bold">
                                Penalty Minutes: <?= number_format((int)$player['pm'], 2); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
<?php require "includes/footer.php"; ?>