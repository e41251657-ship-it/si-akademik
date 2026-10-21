<?php

class AuthController
{
    public function loginForm()
    {
        include "../app/Views/auth/login.php";
    }

    public function login()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (
            $username === 'erlin' &&
            $password === '1901'
        ) {

            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = 'Erlin'; 
            $_SESSION['flash'] = 'Selamat datang, Erlin';

            echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
            exit;
        }

        echo "Login gagal";
    }

    public function logout()
    {
        $_SESSION = [];

        session_destroy();

        session_start();

        $_SESSION['flash'] = 'Anda telah logout';

        header('Location: /akademik10/public/login');
        exit;
    }
}