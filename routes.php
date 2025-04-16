<?php
require_once 'controllers/RegisterController.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$controller = new RegisterController();

if ($uri === '/register' && $method === 'GET') {
    $controller->showForm();
} elseif ($uri === '/register' && $method === 'POST') {
    $controller->registerUser();
} else {
    echo "Página no encontrada (404)";
}
?>