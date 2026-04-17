<?php include __DIR__ . '/partials/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card shadow">
            <div class="card-body">

                <h3 class="text-center mb-4">🛒 Finaliser votre commande</h3>

                <form method="POST" action="index.php?page=orderCreate">

                  
                    <input type="hidden" name="menu_id" value="<?= $menu_id ?>">

                  
                    <div class="mb-3">
                        <label class="form-label">Adresse de livraison</label>
                        <textarea name="adresse" class="form-control" rows="3" required></textarea>
                    </div>

                   
                    <div class="mb-3">
                        <label class="form-label">Heure de livraison</label>
                        <input type="datetime-local" name="livraison_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Distance (km)</label>
                        <input type="number" step="0.1" name="distance" class="form-control" required>
                    </div>

                   
                    <div class="d-grid">
                        <button class="btn btn-success">
                            ✅ Confirmer la commande
                        </button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <a href="index.php?page=menu" class="btn btn-secondary">
                        ⬅ Retour au menu
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>