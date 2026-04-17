<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex flex-column min-vh-100">

    <div class="container flex-grow-1">

        <h2 class="mt-4">✏ Modifier menu</h2>

        <form method="POST" action="index.php?page=updateMenu" class="mt-4">

            <input type="hidden" name="id" value="<?= $menu['id'] ?>">

            <div class="mb-2">
                <input class="form-control" name="name" value="<?= $menu['name'] ?>" required>
            </div>

            <div class="mb-2">
                <input class="form-control" name="description" value="<?= $menu['description'] ?>" required>
            </div>

            <div class="mb-2">
                <input class="form-control" name="price" value="<?= $menu['price'] ?>" required>
            </div>

            <div class="mb-2">
                <input class="form-control" name="themes" value="<?= $menu['themes'] ?>">
            </div>

            <div class="mb-3">
                <input class="form-control" name="allergie" value="<?= $menu['allergie'] ?>">
            </div>

            <button class="btn btn-primary">💾 Modifier</button>

        </form>

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</div>