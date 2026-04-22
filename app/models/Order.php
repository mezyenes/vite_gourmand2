<?php

class Order {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    //  créer commande
    public function create($user_id, $menu_id, $adresse, $livraison_time, $delivery_price) {

        $sql = "INSERT INTO orders (user_id, menu_id, adresse, livraison_time, delivery_price, status) 
                VALUES (?, ?, ?, ?, ?, 'en cours')";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id, $menu_id, $adresse, $livraison_time, $delivery_price]);
    }

    //  commandes des users 
    public function getUserOrders($user_id) {

        $sql = "SELECT orders.*, menus.name, menus.price 
                FROM orders
                JOIN menus ON orders.menu_id = menus.id
                WHERE orders.user_id = ?
                ORDER BY orders.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_id]);

        return $stmt->fetchAll();
    }

    //  commandes employé avec filtre
    public function getAllOrders($status = null) {

        if ($status && $status !== 'all') {

            $sql = "SELECT orders.*, menus.name, menus.price, users.email, users.gsm 
                    FROM orders
                    JOIN menus ON orders.menu_id = menus.id
                    JOIN users ON orders.user_id = users.id
                    WHERE orders.status = ?
                    ORDER BY orders.id DESC";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$status]);

            return $stmt->fetchAll();

        } else {

            $sql = "SELECT orders.*, menus.name, menus.price, users.email, users.gsm 
                    FROM orders
                    JOIN menus ON orders.menu_id = menus.id
                    JOIN users ON orders.user_id = users.id
                    ORDER BY orders.id DESC";

            return $this->pdo->query($sql)->fetchAll();
        }
    }

    //  changer statut avec le crud update toujours
    public function updateStatus($id, $status) {

        $sql = "UPDATE orders 
                SET status = ? 
                WHERE id = ? AND status != 'annulé'";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([$status, $id]);
    }

    // annuler avec raison
    public function cancelWithReason($id, $reason) {

        $sql = "UPDATE orders 
                SET status = 'annulé', cancel_reason = ? 
                WHERE id = ? AND status != 'annulé'";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$reason, $id]);
    }
    
}