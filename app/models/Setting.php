<?php

class Setting {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getHours() {

        $stmt = $this->pdo->query("SELECT * FROM settings LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateHours($opening, $closing) {

        $sql = "UPDATE settings 
                SET opening_time = ?, closing_time = ? 
                WHERE id = 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$opening, $closing]);

        // Si aucune ligne → on insert
        if ($stmt->rowCount() === 0) {
            $sql = "INSERT INTO settings (id, opening_time, closing_time)
                    VALUES (1, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$opening, $closing]);
        }

        return true;
    }
}