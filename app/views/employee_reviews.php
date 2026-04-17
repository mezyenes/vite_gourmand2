<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex flex-column min-vh-100">

    <div class="container flex-grow-1">

        <h2 class="mt-4">⭐ Avis clients (à valider)</h2>

        <div class="mt-4">

        <?php foreach ($reviews as $review): ?>

        <div class="card mb-3 p-3 shadow-sm">

            <h5>🍔 <?= htmlspecialchars($review['name']) ?></h5>

            <p>📧 <?= htmlspecialchars($review['email']) ?></p>

            <p>
                Note :
                <strong><?= str_repeat('⭐', $review['rating']) ?></strong>
            </p>

            <p>
                💬 <?= htmlspecialchars($review['comment']) ?>
            </p>

            <!-- ACTIONS -->
            <a href="index.php?page=approveReview&id=<?= $review['id'] ?>" 
               class="btn btn-success btn-sm">
                ✅ Valider
            </a>

            <a href="index.php?page=rejectReview&id=<?= $review['id'] ?>" 
               class="btn btn-danger btn-sm">
                ❌ Refuser
            </a>

        </div>

        <?php endforeach; ?>

        </div>

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</div>