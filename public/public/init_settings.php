<?php

try {
    $url = parse_url(getenv("DATABASE_URL"));

    $pdo = new PDO(
        "pgsql:host={$url['host']};dbname=" . ltrim($url['path'], '/'),
        $url['user'],
        $url['pass']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS settings (
            id SERIAL PRIMARY KEY,
            opening_time TIME,
            closing_time TIME
        )
    ");

    // Insertion d'une ligne
    $pdo->exec("
        INSERT INTO settings (opening_time, closing_time)
        VALUES ('08:00', '22:00')
    ");

    echo "SETTINGS OK";

} catch (Exception $e) {
    echo $e->getMessage();
}