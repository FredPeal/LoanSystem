<?php
declare(strict_types=1);

namespace App\Http\Controllers;

class AuthController
{
    public function index(): void
    {
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        $data = $_POST;
        if ($data['username'] == 'admin' && $data['password'] == 'admin') {
            $_SESSION['username'] = $data['username'];
            $_SESSION['password'] = $data['password'];
            $_SESSION['timestamp'] = time();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['session' => $_SESSION]);
            session_destroy();
            echo json_encode(['status' => 'error','session' => $_SESSION]);
        }
    }

    public function register(): void
    {
        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function signUp(): void
    {
        // to do , register data from register form to database
    }
}
