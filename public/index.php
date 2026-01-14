<?php
// Front controller principal
// Route les requêtes vers les bons contrôleurs

require __DIR__ . '/../src/config/config.php';
require __DIR__ . '/../src/config/db.php';

// Exemple de routing très simple avec le paramètre ?page=
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'product':
        require __DIR__ . '/../src/controllers/ProductController.php';
        $controller = new ProductController();
        $controller->show();
        break;
    case 'cart':
        require __DIR__ . '/../src/controllers/CartController.php';
        $controller = new CartController();
        $controller->showCart();
        break;
    case 'checkout':
        require __DIR__ . '/../src/controllers/OrderController.php';
        $controller = new OrderController();
        $controller->checkout();
        break;
    case 'login':
        require __DIR__ . '/../src/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
    case 'register':
        require __DIR__ . '/../src/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->register();
        break;
    default:
        require __DIR__ . '/../src/controllers/ProductController.php';
        $controller = new ProductController();
        $controller->home();
        break;
}
