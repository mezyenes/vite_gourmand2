<?php include __DIR__ . '/partials/header.php'; ?>

<h2 class="mb-4">🍔 Notre Menu</h2>

<div class="row">

<?php foreach ($menus as $menu): ?>

    <div class="col-md-4">
        <div class="card mb-4 shadow-sm h-100">

            <?php if (!empty($menu['image'])): ?>
                <img src="images/<?= htmlspecialchars($menu['image']) ?>" 
                     class="card-img-top" 
                     alt="<?= htmlspecialchars($menu['name']) ?>">
            <?php endif; ?>

            <div class="card-body d-flex flex-column">

                <h5 class="card-title"><?= htmlspecialchars($menu['name']) ?></h5>

                <p class="card-text">
                    <?= htmlspecialchars($menu['description']) ?>
                </p>

                <p class="text-success fw-bold">
                    <?= $menu['price'] ?> €
                </p>

                <div class="mt-auto">
                    <a href="index.php?page=menuShow&id=<?= $menu['id'] ?>" 
                       class="btn btn-primary w-100">
                        🔍 Voir détails
                    </a>
                </div>

            </div>

        </div>
    </div>

<?php endforeach; ?>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>