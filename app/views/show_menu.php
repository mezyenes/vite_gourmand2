<?php include __DIR__ . '/partials/header.php'; ?>

<div class="card mb-4 shadow-sm" style="max-width: 500px; margin:auto;">

    <?php if (!empty($menu['image'])): ?>
        <img src="images/<?= htmlspecialchars($menu['image']) ?>" 
             class="card-img-top"
             style="height: 250px; object-fit: cover;"
             alt="<?= htmlspecialchars($menu['name']) ?>">
    <?php endif; ?>

    <div class="card-body">

        <h2 class="card-title"><?= $menu['name'] ?></h2>

        <p class="card-text"><?= $menu['description'] ?></p>

        <p><strong>Prix :</strong> <?= $menu['price'] ?> €</p>

        <p><strong>Thèmes :</strong> <?= $menu['themes'] ?></p>

        <p><strong>Allergies :</strong> <?= $menu['allergie'] ?></p>

        <hr>

        <?php if (isset($_SESSION['user'])): ?>

            <a href="index.php?page=orderForm&menu_id=<?= $menu['id'] ?>" class="btn btn-success w-100">
                Commander
            </a>

        <?php else: ?>

            <div class="alert alert-warning">
                ⚠️ Tu dois être connecté pour commander
            </div>

            <a href="index.php?page=login" class="btn btn-primary w-100">
                Se connecter
            </a>

        <?php endif; ?>

    </div>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>