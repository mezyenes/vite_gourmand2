<?php include __DIR__ . '/partials/header.php'; ?>

<h2>✏ Modifier menu</h2>

<form method="POST" action="index.php?page=updateMenu">

    <input type="hidden" name="id" value="<?= $menu['id'] ?>">

    <input name="name" value="<?= $menu['name'] ?>" required>
    <input name="description" value="<?= $menu['description'] ?>" required>
    <input name="price" value="<?= $menu['price'] ?>" required>
    <input name="themes" value="<?= $menu['themes'] ?>">
    <input name="allergie" value="<?= $menu['allergie'] ?>">

    <button class="btn btn-primary">💾 Modifier</button>

</form>

<?php include __DIR__ . '/partials/footer.php'; ?>