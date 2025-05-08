<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluye todos los controladores
require_once __DIR__ . '/../app/controllers/AuthController.php';

// Determina la acción solicitada
$action = $_GET['action'] ?? 'register';

// Maneja la acción
$authController = new AuthController();

if(method_exists($authController, $action)) {
    $authController->$action();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Página no encontrada";
}