<?php

try {
    if (getenv("DATABASE_URL")) {
        // 👉 HEROKU (PostgreSQL)
        $url = parse_url(getenv("DATABASE_URL"));

        $host = $url["host"];
        $user = $url["user"];
        $pass = $url["pass"];
        $db   = ltrim($url["path"], '/');
        $port = $url["port"] ?? 5432;

        $pdo = new PDO(
            "pgsql:host=$host;port=$port;dbname=$db",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]
        );

    } else {
        // 👉 LOCAL (MySQL)
        $host = 'localhost';
        $db   = 'vite_gourmand3';
        $user = 'root';
        $pass = '';

        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Erreur DB : " . $e->getMessage());
}