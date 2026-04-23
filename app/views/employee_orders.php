<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex flex-column min-vh-100">

    <div class="container flex-grow-1">

        <h2 class="mb-4 mt-4">📦 Toutes les commandes</h2>

        <?php $current = $_GET['status'] ?? 'all'; ?>

        <!-- 🔥 FILTRE -->
        <div class="mb-4">

            <a href="index.php?page=employeeOrders&status=all"
               class="btn btn-dark btn-sm <?= $current == 'all' ? 'active' : '' ?>">
                Toutes
            </a>

            <a href="index.php?page=employeeOrders&status=en cours"
               class="btn btn-warning btn-sm <?= $current == 'en cours' ? 'active' : '' ?>">
                En cours
            </a>

            <a href="index.php?page=employeeOrders&status=en préparation"
               class="btn btn-primary btn-sm <?= $current == 'en préparation' ? 'active' : '' ?>">
                Préparation
            </a>

            <a href="index.php?page=employeeOrders&status=livré"
               class="btn btn-success btn-sm <?= $current == 'livré' ? 'active' : '' ?>">
                Livré
            </a>

            <a href="index.php?page=employeeOrders&status=annulé"
               class="btn btn-danger btn-sm <?= $current == 'annulé' ? 'active' : '' ?>">
                Annulé
            </a>

        </div>

        <div class="row">

        <?php foreach ($orders as $order): ?>

        <div class="col-md-6">
        <div class="card mb-4 shadow-sm h-100">

            <div class="card-body">

                <!-- 🍔 NOM -->
                <h5 class="fw-bold">
                    🍔 <?= htmlspecialchars($order['name'] ?? 'Menu inconnu') ?>
                </h5>

                <!-- 📧 EMAIL -->
                <p class="mb-1">
                    📧 <?= htmlspecialchars($order['email'] ?? 'N/A') ?>
                </p>

                <!-- 📱 GSM -->
                <p class="mb-1">
                    📱 <?= htmlspecialchars($order['gsm'] ?? 'N/A') ?>
                </p>

                <!-- 📍 ADRESSE -->
                <p class="mb-1">
                    📍 <?= htmlspecialchars($order['adresse'] ?? 'N/A') ?>
                </p>

                <!-- ⏰ LIVRAISON -->
                <p class="mb-3">
                    ⏰ <?= htmlspecialchars($order['livraison_time'] ?? 'N/A') ?>
                </p>

                <hr>

                <!-- 💶 PRIX -->
                <p><strong>Prix menu :</strong> <?= number_format((float)($order['price'] ?? 0), 2) ?> €</p>

                <p><strong>Livraison :</strong> <?= number_format((float)($order['delivery_price'] ?? 0), 2) ?> €</p>

                <p class="fs-5">
                    <strong>Total :</strong> 
                    <span class="text-success fw-bold">
                        <?= number_format(
                            (float)($order['price'] ?? 0) + (float)($order['delivery_price'] ?? 0),
                            2
                        ) ?> €
                    </span>
                </p>

                <hr>

                <!-- ✅ STATUS -->
                <p>
                    Statut :
                    <span class="badge 
                        <?php
                            $status = $order['status'] ?? 'inconnu';

                            if ($status == 'en cours') echo 'bg-warning text-dark';
                            elseif ($status == 'en préparation') echo 'bg-primary';
                            elseif ($status == 'livré') echo 'bg-success';
                            elseif ($status == 'annulé') echo 'bg-danger';
                            else echo 'bg-secondary';
                        ?>
                    ">
                        <?= htmlspecialchars($status) ?>
                    </span>
                </p>

                <!-- ACTIONS -->
                <?php if ($status !== 'annulé' && $status !== 'livré'): ?>

                    <div class="d-flex flex-wrap gap-2 mt-3">

                        <a href="index.php?page=updateOrderStatus&id=<?= (int)($order['id'] ?? 0) ?>&status=en préparation" 
                           class="btn btn-warning btn-sm">
                            🔄 Préparation
                        </a>

                        <a href="index.php?page=updateOrderStatus&id=<?= (int)($order['id'] ?? 0) ?>&status=livré" 
                           class="btn btn-success btn-sm">
                            ✅ Livré
                        </a>

                    </div>

                    <form method="POST" action="index.php?page=cancelOrder" class="mt-3">

                        <input type="hidden" name="id" value="<?= (int)($order['id'] ?? 0) ?>">

                        <input type="text" name="reason" class="form-control mb-2"
                               placeholder="Motif annulation" required>

                        <button class="btn btn-danger btn-sm w-100">
                            ❌ Annuler
                        </button>

                    </form>

                <?php elseif ($status == 'annulé'): ?>

                    <div class="alert alert-danger mt-3">
                        ❌ Commande annulée (modification impossible)
                    </div>

                    <?php if (!empty($order['cancel_reason'])): ?>
                        <p class="text-danger">
                            Motif : <?= htmlspecialchars($order['cancel_reason']) ?>
                        </p>
                    <?php endif; ?>

                <?php elseif ($status == 'livré'): ?>

                    <div class="alert alert-success mt-3">
                        ✅ Commande livrée
                    </div>

                <?php endif; ?>

            </div>

        </div>
        </div>

        <?php endforeach; ?>

        </div>

    </div>

    <?php include __DIR__ . '/partials/footer.php'; ?>

</div>