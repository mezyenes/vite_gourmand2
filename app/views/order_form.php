<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex flex-column min-vh-100">

    <div class="container flex-grow-1">

        <!-- ✅ MESSAGE SUCCESS -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success text-center mt-4">
                🎉 Votre commande a été enregistrée avec succès !
            </div>
        <?php endif; ?>

        <div class="row justify-content-center mt-4">

            <div class="col-md-6">

                <div class="card shadow">

                    <div class="card-body">

                        <h3 class="text-center mb-4">🛒 Finaliser votre commande</h3>

                        <form method="POST" action="index.php?page=orderCreate">

                            <!-- menu_id sécurisé -->
                            <input type="hidden" name="menu_id" value="<?= htmlspecialchars($menu_id ?? '') ?>">

                            <!-- Adresse -->
                            <div class="mb-3">
                                <label class="form-label">Adresse de livraison</label>
                                <textarea name="adresse" class="form-control" rows="3" required></textarea>
                            </div>

                            <!-- Heure -->
                            <div class="mb-3">
                                <label class="form-label">Heure de livraison</label>
                                <input type="datetime-local" name="livraison_time" class="form-control" required>
                            </div>

                            <!-- Distance -->
                            <div class="mb-3">
                                <label class="form-label">Distance (km)</label>
                                <input type="number" step="0.1" name="distance" class="form-control" required>
                            </div>

                            <!-- Submit -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
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

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</div>