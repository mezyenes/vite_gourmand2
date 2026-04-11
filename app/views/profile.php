<?php include __DIR__ . '/partials/header.php'; ?>

<h2>👤 Mon Profil</h2>

<?php if (isset($_GET['success'])): ?>
    <div class="alert alert-success">
        ✅ Profil mis à jour avec succès !
    </div>
<?php endif; ?>

<form method="POST" action="index.php?page=updateProfile">

    <div class="mb-2">
        <label>Nom</label>
        <input type="text" name="nom" 
               value="<?= $_SESSION['user']['nom'] ?>" 
               class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Prénom</label>
        <input type="text" name="prenom" 
               value="<?= $_SESSION['user']['prenom'] ?>" 
               class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Email</label>
        <input type="email" name="email" 
               value="<?= $_SESSION['user']['email'] ?>" 
               class="form-control" required>
    </div>

    <div class="mb-2">
        <label>Adresse</label>
        <textarea name="adresse" class="form-control"><?= $_SESSION['user']['adresse'] ?></textarea>
    </div>

    <div class="mb-2">
        <label>Téléphone</label>
        <input type="text" name="gsm" 
               value="<?= $_SESSION['user']['gsm'] ?>" 
               class="form-control">
    </div>

    <button class="btn btn-primary mt-3">
        💾 Mettre à jour
    </button>

</form>

<?php include __DIR__ . '/partials/footer.php'; ?>