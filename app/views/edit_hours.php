<?php include __DIR__ . '/partials/header.php'; ?>

<h2>🕒 Modifier les horaires</h2>

<div class="card p-4 shadow-sm">

<form method="POST" action="index.php?page=updateHours">

    <div class="mb-3">
        <label>Heure ouverture</label>
        <input type="time" name="opening_time" 
               value="<?= $hours['opening_time'] ?>" 
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Heure fermeture</label>
        <input type="time" name="closing_time" 
               value="<?= $hours['closing_time'] ?>" 
               class="form-control">
    </div>

    <button class="btn btn-success">
        Enregistrer
    </button>

</form>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>