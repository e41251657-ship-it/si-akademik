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

        $_SESSION['flash'] = [
            'type' => 'success',
            'message' => 'Selamat datang, Erlin!'
        ];

        header('Location: /akademik14/public/mahasiswa');
        exit;
    }

    echo "Login gagal";
}

public function logout()
{
    $_SESSION = [];

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();

        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params['path'],
            $params['domain'],
            $params['secure'],
            $params['httponly']
        );
    }

    session_destroy();

    header('Location: /akademik14/public/login');
    exit;
}
}