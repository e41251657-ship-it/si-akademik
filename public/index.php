<?php

session_start();

require_once '../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$base = '/akademik10/public';

if (str_starts_with($uri, $base)) {

    $uri = substr($uri, strlen($base));

    if ($uri == '') {
        $uri = '/';
    }
}

$method = $_SERVER['REQUEST_METHOD'];

/*
|--------------------------------------------------------------------------
| Middleware Auth
|--------------------------------------------------------------------------
*/
if (
    $uri === '/dashboard'
    ||
    $uri === '/mahasiswa'
    ||
    $uri === '/mahasiswa/create'
) {

    require_once '../app/Core/Middleware/AuthMiddleware.php';

    $middleware = new AuthMiddleware();

    $middleware->handle();
}

/*
|--------------------------------------------------------------------------
| Routing Biasa
|--------------------------------------------------------------------------
*/
if (isset($routes[$method][$uri])) {

    [$controllerName, $action] = $routes[$method][$uri];

    require_once "../app/Controllers/$controllerName.php";

if ($controllerName === 'MahasiswaController') {
    require_once "../app/Core/Database.php";
    require_once "../app/Repositories/MahasiswaRepository.php";

    $database = Database::getInstance();
    $repository = new MahasiswaRepository($database);
    $controller = new MahasiswaController($repository);
} else {
    $controller = new $controllerName();
}

$controller->$action();
}

/*
|--------------------------------------------------------------------------
| Routing Parameter
|--------------------------------------------------------------------------
*/
elseif (preg_match('#^/mahasiswa/([0-9]+)$#', $uri, $matches)) {

    require_once "../app/Controllers/MahasiswaController.php";

    $controller = new MahasiswaController();

    $controller->show($matches[1]);
}

/*
|--------------------------------------------------------------------------
| 404
|--------------------------------------------------------------------------
*/
else {

    http_response_code(404);

    echo "<h1>404 - Halaman tidak ditemukan</h1>";
}