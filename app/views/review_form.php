<?php include __DIR__ . '/partials/header.php'; ?>

<h2>⭐ Laisser un avis</h2>

<div class="card p-4 shadow-sm">

    <form method="POST" action="index.php?page=reviewCreate">

        <input type="hidden" name="order_id" value="<?= $_GET['order_id'] ?>">

        
        <div class="mb-3">
            <label>Note (1 à 5)</label>
            <select name="rating" class="form-control" required>
                <option value="">Choisir</option>
                <option value="1">⭐ 1</option>
                <option value="2">⭐⭐ 2</option>
                <option value="3">⭐⭐⭐ 3</option>
                <option value="4">⭐⭐⭐⭐ 4</option>
                <option value="5">⭐⭐⭐⭐⭐ 5</option>
            </select>
        </div>

       
        <div class="mb-3">
            <label>Commentaire</label>
            <textarea name="comment" class="form-control" rows="4" required></textarea>
        </div>

        <button class="btn btn-success">
            Envoyer mon avis
        </button>

    </form>

</div>

<?php include __DIR__ . '/partials/footer.php'; ?>