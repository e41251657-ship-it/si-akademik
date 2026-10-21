<?php

class AuthMiddleware
{
    public function handle()
    {

        if (
            empty($_SESSION['logged_in'])
        ) {

            header(
                'Location: /akademik9/public/login'
            );

            exit;
        }
    }
}