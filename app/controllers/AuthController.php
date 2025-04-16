<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function register() {
        // Verificar si se envió el formulario
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Procesar el formulario
            $user = new User();
            
            // Asignar valores
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->password = $_POST['password'];
            
            // Validaciones
            $errors = [];
            
            if(empty($user->name)) {
                $errors[] = 'El nombre es requerido';
            }
            
            if(empty($user->email)) {
                $errors[] = 'El email es requerido';
            } elseif(!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'El email no es válido';
            } elseif($user->emailExists()) {
                $errors[] = 'El email ya está registrado';
            }
            
            if(empty($user->password)) {
                $errors[] = 'La contraseña es requerida';
            } elseif(strlen($user->password) < 6) {
                $errors[] = 'La contraseña debe tener al menos 6 caracteres';
            }
            
            // Si no hay errores, crear el usuario
            if(empty($errors)) {
                if($user->create()) {
                    // Redirigir o mostrar mensaje de éxito
                    header('Location: /login?registered=1');
                    exit;
                } else {
                    $errors[] = 'Ocurrió un error al registrar el usuario';
                }
            }
            
            // Mostrar vista con errores
            require_once __DIR__ . '/../views/auth/register.php';
        } else {
            // Mostrar formulario
            require_once __DIR__ . '/../views/auth/register.php';
        }
    }
}