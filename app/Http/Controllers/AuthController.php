<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;

class AuthController
{
    public function index(): void
    {
        require_once __DIR__ . '/../../views/auth/login.php';
    }

    public function login(): void
    {
        $data = $_POST;
        $user = User::find('email', $data['email']);
        session_destroy();
        if (!$user) {
            echo json_encode(['status' => 'error', 'message' => 'Email not found']);
            return;
        }
        if (password_verify($data['password'], $user['password'])) {
            session_start();
            unset($user['password']);
            $_SESSION['user'] = $user;
            header('Location: /auth/profile');
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
        }
    }

    public function profile(): void
    {
        session_start();
        print_r($_SESSION);
    }

    public function register(): void
    {
        require_once __DIR__ . '/../../views/auth/register.php';
    }

    public function signUp(): void
    {
        $data = $_POST;
        User::create($data);
        header('Location: /auth/login');
    }

    public function signIn(): void
    {

    }
}
