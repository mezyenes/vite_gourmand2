<?php

require_once __DIR__ . '/../models/Order.php';

class OrderController {

    private $orderModel;

    public function __construct($pdo) {
        $this->orderModel = new Order($pdo);
        $GLOBALS['pdo'] = $pdo;
    }

    // =========================
    // CRÉER UNE COMMANDE
    // =========================
    public function create() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $user_id = $_SESSION['user']['id'];

        // 🔥 sécurisation POST (EVITE "undefined index")
        $menu_id = $_POST['menu_id'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $livraison_time = $_POST['livraison_time'] ?? null;
        $distance = isset($_POST['distance']) ? (float)$_POST['distance'] : 0;

        // ❌ validation propre
        if (empty($menu_id) || empty($adresse) || empty($livraison_time)) {
            die("Erreur : données manquantes (menu_id, adresse ou livraison_time vide)");
        }

        // format SQL
        $livraison_time = str_replace('T', ' ', $livraison_time);

        // calcul livraison
        $delivery_price = 0;

        if (stripos($adresse, 'bordeaux') === false) {
            $delivery_price = 5 + ($distance * 0.59);
        }

        $delivery_price = round($delivery_price, 2);

        // INSERT DB
        $this->orderModel->create(
            $user_id,
            $menu_id,
            $adresse,
            $livraison_time,
            $delivery_price
        );

        // redirect
        header('Location: index.php?page=orderForm&menu_id=' . $menu_id . '&success=1');
exit;
    }

    // =========================
    // FORMULAIRE COMMANDE
    // =========================
    public function form() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $menu_id = $_GET['menu_id'] ?? null;

        if (!$menu_id) {
            die("Menu introuvable");
        }

        require __DIR__ . '/../views/order_form.php';
    }

    // =========================
    // MES COMMANDES
    // =========================
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

    // =========================
    // ANNULER COMMANDE
    // =========================
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