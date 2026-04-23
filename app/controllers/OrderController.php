<?php

require_once __DIR__ . '/../models/Order.php';

// 🆕 AJOUT : connexion MongoDB pour stats admin
require_once __DIR__ . '/../config/DatabaseMongo.php';

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

        // 🔥 sécurisation POST
        $menu_id = $_POST['menu_id'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $livraison_time = $_POST['livraison_time'] ?? null;
        $distance = isset($_POST['distance']) ? (float)$_POST['distance'] : 0;

        if (empty($menu_id) || empty($adresse) || empty($livraison_time)) {
            die("Erreur : données manquantes");
        }

        // format date
        $livraison_time = str_replace('T', ' ', $livraison_time);

        // calcul livraison
        $delivery_price = 0;

        if (stripos($adresse, 'bordeaux') === false) {
            $delivery_price = 5 + ($distance * 0.59);
        }

        $delivery_price = round($delivery_price, 2);

        // =========================
        // 🟢 INSERT SQL (EXISTANT)
        // =========================
        $this->orderModel->create(
            $user_id,
            $menu_id,
            $adresse,
            $livraison_time,
            $delivery_price
        );

        // =========================
        // 🟡 AJOUT MONGO (NOUVEAU)
        // pour stats admin dashboard
        // =========================
        $db = DatabaseMongo::connect();

        $db->orders->insertOne([
            "user_id" => $user_id,
            "menu_id" => $menu_id,
            "menu_name" => "menu_" . $menu_id, // simple pour stats
            "adresse" => $adresse,
            "livraison_time" => $livraison_time,
            "distance" => $distance,
            "quantity" => 1, // pour aggregation
            "total" => $delivery_price, // pour revenue stats
            "created_at" => date("Y-m-d H:i:s")
        ]);

        // =========================
        // REDIRECT
        // =========================
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