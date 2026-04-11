<?php

session_start();

require '../config/database.php';

require '../app/controllers/HomeController.php';
require '../app/controllers/MenuController.php';
require __DIR__ . '/../app/controllers/AuthController.php';
require __DIR__ . '/../app/controllers/OrderController.php';
require __DIR__ . '/../app/controllers/AdminController.php';
require __DIR__ . '/../app/controllers/EmployeeController.php';
require __DIR__ . '/../app/controllers/ReviewController.php';

$page = $_GET['page'] ?? 'home';

switch ($page) {

    case 'home':
        (new HomeController($pdo))->index();
        break;

    case 'menu':
        (new MenuController($pdo))->index();
        break;

    case 'menuShow':
        (new MenuController($pdo))->show();
        break;

    case 'order':
        (new OrderController($pdo))->create();
        break;

    case 'orderForm':
        (new OrderController($pdo))->form();
        break;

    case 'orderCreate':
        (new OrderController($pdo))->create();
        break;

    // 👤 utilisateur
    case 'myOrders':
        (new OrderController($pdo))->myOrders();
        break;

    case 'cancelOrder':
        (new OrderController($pdo))->cancel();
        break;

    // 👨‍🍳 employé (horaires)
    case 'editHours':
        (new EmployeeController($pdo))->editHours();
        break;

    case 'updateHours':
        (new EmployeeController($pdo))->updateHours();
        break;

    // 👨‍🍳 employé commandes
    case 'employeeOrders':
        (new EmployeeController($pdo))->orders();
        break;

    case 'updateOrderStatus':
        (new EmployeeController($pdo))->updateStatus();
        break;

    case 'cancelOrderEmployee':
        (new EmployeeController($pdo))->cancel();
        break;

    // 🔐 auth
    case 'login':
        (new AuthController($pdo))->login();
        break;

    case 'loginPost':
        (new AuthController($pdo))->loginPost();
        break;

    case 'register':
        (new AuthController($pdo))->register();
        break;

    case 'registerPost':
        (new AuthController($pdo))->registerPost();
        break;

    case 'profile':
        (new AuthController($pdo))->profile();
        break;

    case 'updateProfile':
        (new AuthController($pdo))->updateProfile();
        break;

    case 'logout':
        (new AuthController($pdo))->logout();
        break;

    // 👑 admin
    case 'adminUsers':
        (new AdminController($pdo))->users();
        break;

    case 'toggleUser':
        (new AdminController($pdo))->toggleUser();
        break;

    case 'createEmployee':
        (new AdminController($pdo))->createEmployee();
        break;

    case 'createMenu':
        (new AdminController($pdo))->createMenu();
        break;

    case 'deleteMenu':
        (new AdminController($pdo))->deleteMenu();
        break;

    case 'editMenu':
        (new AdminController($pdo))->editMenu();
        break;

    case 'updateMenu':
        (new AdminController($pdo))->updateMenu();
        break;

    // ⭐ avis
    case 'reviewForm':
        (new ReviewController($pdo))->form();
        break;

    case 'reviewCreate':
        (new ReviewController($pdo))->create();
        break;

    case 'employeeReviews':
        (new ReviewController($pdo))->admin();
        break;

    case 'approveReview':
        (new ReviewController($pdo))->approve();
        break;

    case 'rejectReview':
        (new ReviewController($pdo))->reject();
        break;



        case 'contact':
    require __DIR__ . '/../app/views/contact.php';
    break;

    default:
        echo "404 - Page non trouvée";
        break;
}