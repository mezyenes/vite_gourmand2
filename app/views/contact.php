<?php include __DIR__ . '/partials/header.php'; ?>

<h2 class="mb-4">📞 Contact</h2>

<div class="row">

    <!-- INFOS -->
    <div class="col-md-6">
        <div class="card p-4 shadow-sm mb-4">

            <h4>📍 Nos informations</h4>

            <p><strong>Adresse :</strong> 12 rue de Bordeaux, 33000 Bordeaux</p>
            <p><strong>Téléphone :</strong> 06 29 15 30 39</p>
            <p><strong>Email :</strong> contact@vitegourmand.fr</p>

        </div>
    </div>

    <!-- FORMULAIRE -->
    <div class="col-md-6">
        <div class="card p-4 shadow-sm">

            <h4>📨 Nous contacter</h4>

            <form method="POST" action="#">

                <div class="mb-3">
                    <label class="form-label">Nom</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="4" required></textarea>
                </div>

                <button class="btn btn-primary w-100">
                    Envoyer
                </button>

            </form>

        </div>
    </div>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>