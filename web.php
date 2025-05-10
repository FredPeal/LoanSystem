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
    $router->get('/auth/profile', AuthController::class.'@profile');
    // "App\Http\Controllers\AuthController@register";
    $router->get('/auth/register', AuthController::class.'@register');
    $router->post('/auth/register', AuthController::class.'@signUp');
    


    $router->run();

} catch (\Throwable $e) {
    echo json_encode(['error' => $e->getMessage()]);
}