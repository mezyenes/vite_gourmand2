<?php

require_once __DIR__ . '/../models/Order.php';

class OrderController {

    private $orderModel;

    public function __construct($pdo) {
        $this->orderModel = new Order($pdo);
    }

    // ✅ Créer une commande
    public function create() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        // POST (tes noms gardés)
        $menu_id = $_POST['menu_id'];
        $adresse = $_POST['adresse'];
        $livraison_time = str_replace('T', ' ', $_POST['livraison_time']);

        // ✅ NOUVEAU : distance
        $distance = (float) ($_POST['distance'] ?? 0);

        // ✅ NOUVEAU : calcul livraison
        $delivery_price = 0;

        if (stripos($adresse, 'bordeaux') === false) {
            $delivery_price = 5 + ($distance * 0.59);
        }

        $delivery_price = round($delivery_price, 2);

        // ⚠️ IMPORTANT : on envoie aussi delivery_price
        $this->orderModel->create($user_id, $menu_id, $adresse, $livraison_time, $delivery_price);

        header('Location: index.php?page=menu&order=success');
        exit;
    }

    // ✅ Formulaire commande
    public function form() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $menu_id = $_GET['menu_id'];

        require __DIR__ . '/../views/order_form.php';
    }

    // ✅ Mes commandes
    public function myOrders() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        $orders = $this->orderModel->getUserOrders($user_id);

        require __DIR__ . '/../views/my_orders.php';
    }

    // ✅ Annuler commande (USER + EMPLOYÉ)
    public function cancel() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $order_id = $_POST['id'] ?? $_GET['id'] ?? null;

        if (!$order_id) {
            die("ID commande manquant");
        }

        $reason = $_POST['reason'] ?? "Annulé par utilisateur";

        $this->orderModel->cancelWithReason($order_id, $reason);

        if ($_SESSION['user']['role'] === 'employe') {
            header('Location: index.php?page=employeeOrders');
        } else {
            header('Location: index.php?page=myOrders');
        }

        exit;
    }
}