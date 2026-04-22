<?php

require __DIR__ . '/config/database.php';

$nom = "Admin";
$prenom = "System";
$email = "juliead@test.com";
$password = password_hash("admin123", PASSWORD_DEFAULT);
$role = "admin";

$sql = "INSERT INTO users (nom, prenom, email, password, role)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $pdo->prepare($sql);
$stmt->execute([$nom, $prenom, $email, $password, $role]);

echo "Admin créé avec succès";