<?php

require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/Setting.php';

class EmployeeController {

    private $orderModel;
    private $settingModel;

    public function __construct($pdo) {
        $this->orderModel = new Order($pdo);
        $this->settingModel = new Setting($pdo);
    }

    public function orders() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employe') {
            header('Location: index.php?page=login');
            exit;
        }

        $status = $_GET['status'] ?? 'all';
        $orders = $this->orderModel->getAllOrders($status);

        require __DIR__ . '/../views/employee_orders.php';
    }

    public function editHours() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employe') {
            header('Location: index.php?page=login');
            exit;
        }

        $hours = $this->settingModel->getHours();

        require __DIR__ . '/../views/edit_hours.php';
    }

    public function updateHours() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // 🔒 sécurité
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'employe') {
            header('Location: index.php?page=login');
            exit;
        }

        // ✅ vérification POST
        if (!isset($_POST['opening_time'], $_POST['closing_time'])) {
            die("Erreur : données manquantes");
        }

        $opening = $_POST['opening_time'];
        $closing = $_POST['closing_time'];

        $this->settingModel->updateHours($opening, $closing);

        header('Location: index.php?page=editHours');
        exit;
    }

public function updateStatus() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $id = $_GET['id'] ?? null;
    $status = $_GET['status'] ?? null;

    if ($id && $status) {
        $this->orderModel->updateStatus($id, $status);
    }

    header('Location: index.php?page=employeeOrders');
    exit;
}







public function cancel() {

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $id = $_POST['id'] ?? null;
    $reason = $_POST['reason'] ?? '';

    if ($id) {
        $this->orderModel->cancelWithReason($id, $reason);
    }

    header('Location: index.php?page=employeeOrders');
    exit;
}










}