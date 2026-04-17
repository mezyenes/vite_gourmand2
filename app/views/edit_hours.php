<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex flex-column min-vh-100">

    <div class="container flex-grow-1">

        <h2 class="mt-4">🕒 Modifier les horaires</h2>

        <div class="card p-4 shadow-sm mt-4">

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

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</div>