<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vite Gourmand</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="index.php">🍔 Vite Gourmand</a>

    <!-- Burger mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">

        <!-- GAUCHE -->
        <ul class="navbar-nav me-auto">

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=menu">Menu</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=contact">Contact</a>
            </li>

            <?php if (isset($_SESSION['user'])): ?>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=profile">Mon profil</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=myOrders">Mes commandes</a>
                </li>

                <?php if ($_SESSION['user']['role'] === 'employe'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="index.php?page=employeeOrders">
                            📦 Commandes
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="index.php?page=employeeReviews">
                            ⭐ Avis
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-warning fw-bold" href="index.php?page=editHours">
                            🕒 Horaires
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link text-info fw-bold" href="index.php?page=adminUsers">
                            ⚙️ Admin
                        </a>
                    </li>

                // boutton des stats 
                    <li class="nav-item">
                        <a class="nav-link text-success fw-bold" href="index.php?page=adminStats">
                            📊 Statistiques
                        </a>
                    </li>
                <?php endif; ?>

            <?php endif; ?>

        </ul>

        <!-- DROITE -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-2">

            <?php if (isset($_SESSION['user'])): ?>

                <span class="text-white me-lg-3">
                    👋 <?= $_SESSION['user']['prenom']; ?>
                </span>

                <a href="index.php?page=logout" class="btn btn-danger btn-sm">
                    Logout
                </a>

            <?php else: ?>

                <a href="index.php?page=login" class="btn btn-primary btn-sm">
                    Se connecter
                </a>

            <?php endif; ?>

        </div>

    </div>

</nav>

<div class="container mt-4">