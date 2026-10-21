<?php

$routes = [

    'GET' => [

        '/' => [
            'HomeController',
            'index'
        ],

        '/login' => [
            'AuthController',
            'loginForm'
        ],

        '/logout' => [
            'AuthController',
            'logout'
        ],

        '/dashboard' => [
            'HomeController',
            'dashboard'
        ],

        '/mahasiswa' => [
            'MahasiswaController',
            'index'
        ],

        '/mahasiswa/create' => [
            'MahasiswaController',
            'create'
        ],

        '/mahasiswa/edit' => [
        'MahasiswaController',
        'edit'
        ],

        '/mahasiswa/delete' => [
        'MahasiswaController',
        'delete'
        ],

    ],

    'POST' => [

        '/login' => [
            'AuthController',
            'login'
        ],

        '/mahasiswa/store' => [
        'MahasiswaController',
        'store'
        ],

        '/mahasiswa/update' => [
        'MahasiswaController',
        'update'
        ],

        '/mahasiswa/delete' => [
        'MahasiswaController',
        'destroy'
        ],

    ]

];