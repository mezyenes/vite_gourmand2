<?php

class Review {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // ➕ créer avis
    public function create($order_id, $user_id, $rating, $comment) {

        $sql = "INSERT INTO reviews (order_id, user_id, rating, comment)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$order_id, $user_id, $rating, $comment]);
    }

    // 🔍 avis en attente (employé)
    public function getPending() {

        $sql = "SELECT reviews.*, users.email, menus.name
                FROM reviews
                JOIN users ON reviews.user_id = users.id
                JOIN orders ON reviews.order_id = orders.id
                JOIN menus ON orders.menu_id = menus.id
                WHERE reviews.status = 'pending'
                ORDER BY reviews.id DESC";

        return $this->pdo->query($sql)->fetchAll();
    }

    // ✅ valider
    public function approve($id) {
        $stmt = $this->pdo->prepare("UPDATE reviews SET status = 'approved' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // ❌ refuser
    public function reject($id) {
        $stmt = $this->pdo->prepare("UPDATE reviews SET status = 'rejected' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // 🌍 avis visibles
    public function getApproved() {

        $sql = "SELECT reviews.*, menus.name
                FROM reviews
                JOIN orders ON reviews.order_id = orders.id
                JOIN menus ON orders.menu_id = menus.id
                WHERE reviews.status = 'approved'
                ORDER BY reviews.id DESC";

        return $this->pdo->query($sql)->fetchAll();
    }
}