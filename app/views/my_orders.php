<?php include __DIR__ . '/partials/header.php'; ?>

<h2>🧾 Mes Commandes</h2>

<div class="row">

<?php foreach ($orders as $order): ?>

    <div class="col-md-4">
        <div class="card mb-3 shadow">

            <div class="card-body">

                <h5><?= $order['name'] ?></h5>

                <p><strong>Adresse :</strong> <?= $order['adresse'] ?></p>

                <p><strong>Livraison :</strong> <?= $order['livraison_time'] ?></p>

                <hr>

                <p><strong>Prix menu :</strong> <?= $order['price'] ?> €</p>

                <p><strong>Frais livraison :</strong> <?= $order['delivery_price'] ?> €</p>

                <p>
                    <strong>Total :</strong> 
                    <span class="text-success fw-bold">
                        <?= number_format($order['price'] + $order['delivery_price'], 2) ?> €
                    </span>
                </p>

                <p>
                    <strong>Status :</strong> 
                    <?= $order['status'] ?>
                </p>

                <?php if ($order['status'] !== 'livré' && $order['status'] !== 'annulé'): ?>

                    <a href="index.php?page=cancelOrder&id=<?= $order['id'] ?>" 
                       class="btn btn-danger">
                        ❌ Annuler
                    </a>

                <?php endif; ?>
                 
                <?php if ($order['status'] == 'livré'): ?>

                    <a href="index.php?page=reviewForm&order_id=<?= $order['id'] ?>" class="btn btn-info btn-sm">
                        ⭐ Laisser un avis
                    </a>

                <?php endif; ?>

            </div>
          
        </div>
    </div>

<?php endforeach; ?>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>