<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

/**
 * Connexion DB
 */
require __DIR__ . '/../config/database.php';

/**
 * Controllers
 */
require __DIR__ . '/../app/controllers/HomeController.php';
require __DIR__ . '/../app/controllers/MenuController.php';
require __DIR__ . '/../app/controllers/AuthController.php';
require __DIR__ . '/../app/controllers/OrderController.php';
require __DIR__ . '/../app/controllers/AdminController.php';
require __DIR__ . '/../app/controllers/EmployeeController.php';
require __DIR__ . '/../app/controllers/ReviewController.php';
require __DIR__ . '/../app/controllers/TestController.php';

/**
 * Router simple
 */
$page = $_GET['page'] ?? 'home';

try {

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

        // =========================
        // ORDER FIX IMPORTANT ICI
        // =========================
        case 'order':
        case 'orderForm':
            (new OrderController($pdo))->form();
            break;

        case 'orderCreate':
            (new OrderController($pdo))->create();
            break;

        case 'myOrders':
            (new OrderController($pdo))->myOrders();
            break;

        case 'cancelOrder':
            (new OrderController($pdo))->cancel();
            break;

        case 'editHours':
            (new EmployeeController($pdo))->editHours();
            break;

        case 'updateHours':
            (new EmployeeController($pdo))->updateHours();
            break;

        case 'employeeOrders':
            (new EmployeeController($pdo))->orders();
            break;

        case 'updateOrderStatus':
            (new EmployeeController($pdo))->updateStatus();
            break;

        case 'cancelOrderEmployee':
            (new EmployeeController($pdo))->cancel();
            break;

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
            include __DIR__ . '/../app/views/contact.php';
            break;

        case 'adminStats':
            (new AdminController($pdo))->stats();
            break;

        case 'cgv':
            include __DIR__ . '/../app/views/cgv.php';
            break;

        case 'mentions':
            include __DIR__ . '/../app/views/mentions.php';
            break;

        case 'privacy':
            include __DIR__ . '/../app/views/privacy.php';
            break;



            case 'mongoTest':
    (new TestController())->mongo();
    break;

        default:
            http_response_code(404);
            echo "404 - Page non trouvée";
            break;
    }

} catch (Throwable $e) {
    echo "<h1>Erreur serveur</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}