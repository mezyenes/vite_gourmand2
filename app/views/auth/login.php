<?php include __DIR__ . '/../partials/header.php'; ?>

<div style="min-height: 70vh;">

    <h2>Connexion</h2>

    <form method="POST" action="index.php?page=loginPost">

        <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>

        <input type="password" name="password" placeholder="Mot de passe" class="form-control mb-2" required>

        <button class="btn btn-primary">Se connecter</button>

    </form>

    <p class="mt-3">
        Pas de compte ?
        <a href="index.php?page=register">S'inscrire</a>
    </p>

</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>