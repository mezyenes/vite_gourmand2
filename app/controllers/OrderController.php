<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Menu.php';
require_once __DIR__ . '/../../config/DatabaseMongo.php';

class OrderController {

    private $orderModel;

    public function __construct($pdo) {
        $this->orderModel = new Order($pdo);
        $GLOBALS['pdo'] = $pdo;
    }

    // =========================
    // CREATE ORDER
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

        $menu_id = $_POST['menu_id'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $livraison_time = $_POST['livraison_time'] ?? null;
        $distance = (float) ($_POST['distance'] ?? 0);

        if (empty($menu_id) || empty($adresse) || empty($livraison_time)) {
            die("❌ Erreur : données manquantes");
        }

        $livraison_time = str_replace('T', ' ', $livraison_time);

        $delivery_price = 0;
        if (stripos($adresse, 'bordeaux') === false) {
            $delivery_price = 5 + ($distance * 0.59);
        }

        $delivery_price = round($delivery_price, 2);

        $this->orderModel->create(
            $user_id,
            $menu_id,
            $adresse,
            $livraison_time,
            $delivery_price
        );

        header('Location: index.php?page=menu&order=success');
        exit;
    }

    // =========================
    // FORM ORDER
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

        if (empty($menu_id)) {
            die("❌ Menu introuvable");
        }

        require __DIR__ . '/../views/order_form.php';
    }
}