<?php

class AuthMiddleware
{
public function handle()
{
    if (
        !isset($_SESSION['logged_in']) ||
        $_SESSION['logged_in'] !== true
    ) {
        header('Location: /akademik14/public/login');
        exit;
    }
}
}