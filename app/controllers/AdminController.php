<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Menu.php';

class AdminController {

    private $userModel;
    private $menuModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
        $this->menuModel = new Menu($pdo);
    }

    //  sécurité globale
    private function checkAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit;
        }
    }

    //  PAGE ADMIN pour gerer tousles users du site 
    public function users() {

        $this->checkAdmin();

        $users = $this->userModel->getAllUsers();

        
        $menus = $this->menuModel->getAll();

        require __DIR__ . '/../views/admin_users.php';
    }

    //  activer / désactiver user
    public function toggleUser() {

        $this->checkAdmin();

        $id = $_GET['id'];

        $this->userModel->toggleActive($id);

        header('Location: index.php?page=adminUsers');
    }

    //  créer employé
    public function createEmployee() {

        $this->checkAdmin();

        $this->userModel->createEmployee(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['email'],
            $_POST['password']
        );

        header('Location: index.php?page=adminUsers&success=1');
    }

    //  créer menu
    public function createMenu() {

        $this->checkAdmin();

        $this->menuModel->create(
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $_POST['theme'],
            $_POST['allergie'],
        );

        header('Location: index.php?page=adminUsers');
    }

    //  supprimer menu
    public function deleteMenu() {

        $this->checkAdmin();

        $this->menuModel->delete($_GET['id']);

        header('Location: index.php?page=adminUsers');
    }

    // afficher formulaire de modif
    public function editMenu() {

        $this->checkAdmin();

        $menu = $this->menuModel->getById($_GET['id']);

        require __DIR__ . '/../views/edit_menu.php';
    }

    // update menu
    public function updateMenu() {

        $this->checkAdmin();

        $this->menuModel->update(
            $_POST['id'],
            $_POST['name'],
            $_POST['description'],
            $_POST['price'],
            $_POST['theme'],
            $_POST['allergie']
        );

        header('Location: index.php?page=adminUsers');
    }




public function testMongo() {

    require_once __DIR__ . '/../models/OrderModel.php';

    $data = OrderModel::getOrdersByMenu();

    echo "<pre>";
    print_r($data);
}


public function stats() {

    $this->checkAdmin(); // sécurité admin

    require_once __DIR__ . '/../models/OrderModel.php';

    $ordersData = OrderModel::getOrdersByMenu();
    $revenueData = OrderModel::getRevenueByMenu();

    require __DIR__ . '/../views/admin_stats.php';
}







}