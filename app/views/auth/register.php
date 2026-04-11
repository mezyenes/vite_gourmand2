<?php include __DIR__ . '/../partials/header.php'; ?>

<div style="min-height: 70vh;">

    <h2>Inscription</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            ✅ Inscription réussie ! Tu peux maintenant te connecter.
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?page=registerPost">

        <input type="text" name="nom" placeholder="Nom" class="form-control mb-2" required>

        <input type="text" name="prenom" placeholder="Prénom" class="form-control mb-2" required>

        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>

        <input type="password" name="password" placeholder="Mot de passe" class="form-control mb-2" required>

        <input type="text" name="adresse" placeholder="Adresse" class="form-control mb-2">

        <input type="text" name="gsm" placeholder="Téléphone" class="form-control mb-2">

        <button class="btn btn-success">S'inscrire</button>

    </form>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>