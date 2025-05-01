<?php
require __DIR__ . '/vendor/autoload.php';

use App\Http\Controllers\AuthController;
try {


    $router = new \Bramus\Router\Router();

    // Define your routes here
    $router->get('/health', function () {
        echo json_encode(['status' => 'ok']);
    });

    $router->get('/auth/login', AuthController::class.'@index');
    $router->post('/auth/login', AuthController::class.'@login');

    $router->run();

} catch (\Throwable $e) {
    echo json_encode(['error' => $e->getMessage()]);
}