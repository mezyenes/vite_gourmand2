<?php include __DIR__ . '/partials/header.php'; ?>

<style>
    body {
        background: linear-gradient(to bottom, #ffffff, #f1f3f5);
    }
</style>

<div class="container mt-5">

    <!-- HERO -->
    <div class="text-center mb-5 py-4">

        <h1 class="fw-bold display-4 mb-3">🍔 Vite & Gourmand</h1>

        <p class="lead text-muted mx-auto" style="max-width: 700px; line-height: 1.6;">
            Bienvenue chez <strong>Vite & Gourmand</strong> 👨‍🍳✨ <br><br>

            Depuis plus de 25 ans, Julie et José mettent leur passion au service de vos événements à Bordeaux.
            Menus faits maison, produits de qualité et savoir-faire reconnu.

            <br><br>
            Découvrez nos menus et commandez facilement en ligne pour tous vos moments spéciaux.

            <br><br>
            <strong>Simple, rapide… et toujours délicieux.</strong> 🚀
        </p>

        <a href="index.php?page=menu" class="btn btn-primary btn-lg px-5 mt-3">
            Voir le menu
        </a>

    </div>

    <!-- AVIS -->
    <div class="mb-5">

        <h3 class="mb-4 text-center">⭐ Avis clients</h3>

        <div class="row g-4">

            <?php if (!empty($reviews)): ?>

                <?php foreach ($reviews as $review): ?>

                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">

                            <div class="card-body d-flex flex-column p-4">

                                <h6 class="fw-bold mb-2">
                                    👤 <?= htmlspecialchars($review['name']) ?>
                                </h6>

                                <div class="mb-2 text-warning">
                                    <?= str_repeat('⭐', (int)$review['rating']) ?>
                                </div>

                                <p class="text-muted flex-grow-1 mb-0">
                                    <?= htmlspecialchars($review['comment']) ?>
                                </p>

                            </div>

                        </div>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p class="text-center text-muted">Aucun avis pour le moment.</p>

            <?php endif; ?>

        </div>

    </div>

    <!-- SEPARATION -->
    <hr class="my-5">

    <!-- HORAIRES -->
    <div class="text-center mb-5">

        <h4 class="mb-4">🕒 Horaires d'ouverture</h4>

        <div class="card mx-auto shadow-sm p-4" style="max-width: 400px; border-radius: 12px;">

            <p class="mb-0 fs-5">
                Ouvert 7/7 de <br>

                <strong class="text-success">
                    <?= htmlspecialchars($hours['opening_time'] ?? '??:??') ?>
                </strong>

                à

                <strong class="text-danger">
                    <?= htmlspecialchars($hours['closing_time'] ?? '??:??') ?>
                </strong>
            </p>

        </div>

    </div>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>