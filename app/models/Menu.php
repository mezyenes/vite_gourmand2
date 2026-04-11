<?php

class Menu {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // 🔥 récupérer tous les menus
    public function getAll() {
        $sql = "SELECT * FROM menus ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    // 🔍 récupérer UN menu
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM menus WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // ➕ créer menu
    public function create($name, $description, $price, $themes, $allergie) {

        $sql = "INSERT INTO menus (name, description, price, themes, allergie)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description, $price, $themes, $allergie]);
    }

    // ✏ modifier menu
    public function update($id, $name, $description, $price, $themes, $allergie) {

        $sql = "UPDATE menus 
                SET name = ?, description = ?, price = ?, themes = ?, allergie = ? 
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$name, $description, $price, $themes, $allergie, $id]);
    }

    // ❌ supprimer menu
    public function delete($id) {

        $stmt = $this->pdo->prepare("DELETE FROM menus WHERE id = ?");
        return $stmt->execute([$id]);
    }
}