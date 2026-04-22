<?php include __DIR__ . '/partials/header.php'; ?>

<?php if (empty($menu_id)) die("menu_id manquant"); ?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow">
            <div class="card-body">

                <h3 class="text-center mb-4">🛒 Finaliser votre commande</h3>

                <!-- IMPORTANT FIX ROUTING -->
                <form method="POST" action="index.php">

                    <!-- ROUTE -->
                    <input type="hidden" name="page" value="orderCreate">

                    <!-- MENU ID -->
                    <input type="hidden" name="menu_id" value="<?= htmlspecialchars($menu_id) ?>">

                    <!-- ADRESSE -->
                    <div class="mb-3">
                        <label>Adresse de livraison</label>
                        <textarea name="adresse" class="form-control" required></textarea>
                    </div>

                    <!-- HEURE -->
                    <div class="mb-3">
                        <label>Heure de livraison</label>
                        <input type="datetime-local" name="livraison_time" class="form-control" required>
                    </div>

                    <!-- DISTANCE -->
                    <div class="mb-3">
                        <label>Distance (km)</label>
                        <input type="number" step="0.1" name="distance" class="form-control" required>
                    </div>

                    <!-- SUBMIT -->
                    <button type="submit" class="btn btn-success w-100">
                        Commander
                    </button>

                </form>

                <div class="text-center mt-3">
                    <a href="index.php?page=menu" class="btn btn-secondary">
                        Retour
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>