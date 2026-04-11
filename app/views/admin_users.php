<?php include __DIR__ . '/partials/header.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>👑 Gestion des utilisateurs</h2>

    <a href="index.php?page=menu" class="btn btn-outline-secondary">
        ⬅ Retour au site
    </a>
</div>

<div class="card shadow">
    <div class="card-body">

        <table class="table table-hover align-middle">

            <thead class="table-dark text-center">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>GSM</th>
                    <th>Rôle</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody class="text-center">

                <?php foreach ($users as $user): ?>

                    <tr>

                        <td><?= $user['id'] ?></td>
                        <td><?= $user['nom'] ?></td>
                        <td><?= $user['prenom'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['gsm'] ?></td>

                        <!-- rôle -->
                        <td>
                            <span class="badge bg-info text-dark">
                                <?= ucfirst($user['role']) ?>
                            </span>
                        </td>

                        <!-- status -->
                        <td>
                            <?php if ($user['active']): ?>
                                <span class="badge bg-success">Actif</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Désactivé</span>
                            <?php endif; ?>
                        </td>

                        <!-- action -->
                        <td>

                            <?php if ($user['active']): ?>

                                <a href="index.php?page=toggleUser&id=<?= $user['id'] ?>" 
                                   class="btn btn-danger btn-sm">
                                    ❌ Désactiver
                                </a>

                            <?php else: ?>

                                <a href="index.php?page=toggleUser&id=<?= $user['id'] ?>" 
                                   class="btn btn-success btn-sm">
                                    ✅ Réactiver
                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>





    <div class="card mb-4 shadow">
    <div class="card-body">

        <h4 class="mb-3">➕ Créer un employé</h4>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">
                ✅ Employé créé avec succès !
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?page=createEmployee">

            <div class="row">

                <div class="col-md-3">
                    <input type="text" name="nom" class="form-control" placeholder="Nom" required>
                </div>

                <div class="col-md-3">
                    <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
                </div>

                <div class="col-md-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>

                <div class="col-md-3">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                </div>

            </div>

            <button class="btn btn-success mt-3">
                ➕ Créer employé
            </button>

        </form>

    </div>


<h3>🍔 Ajouter un menu</h3>

<form method="POST" action="index.php?page=createMenu" class="mb-4">

    <input name="name" placeholder="Nom" required>
    <input name="description" placeholder="Description" required>
    <input name="price" type="number" step="0.01" placeholder="Prix" required>
    <input name="theme" placeholder="Thème">
    <input name="allergie" placeholder="Allergie">

    <button class="btn btn-success">Ajouter</button>
</form>

<h3>📋 Liste des menus</h3>

<table class="table table-bordered">

<tr>
    <th>ID</th>
    <th>Nom</th>
    <th>Prix</th>
    <th>Actions</th>
</tr>

<?php foreach ($menus as $menu): ?>

<tr>
    <td><?= $menu['id'] ?></td>
    <td><?= $menu['name'] ?></td>
    <td><?= $menu['price'] ?> €</td>

    <td>
        <a href="index.php?page=editMenu&id=<?= $menu['id'] ?>" class="btn btn-warning btn-sm">✏</a>

        <a href="index.php?page=deleteMenu&id=<?= $menu['id'] ?>" class="btn btn-danger btn-sm">❌</a>
    </td>
</tr>

<?php endforeach; ?>

</table>













</div>
</div>

<?php include __DIR__ . '/partials/footer.php'; ?>