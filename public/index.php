<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');

require_once '../routes/web.php';

try {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $base = '/akademik14/public';

    if (str_starts_with($uri, $base)) {
        $uri = substr($uri, strlen($base));

        if ($uri === '') {
            $uri = '/';
        }
    }

    $method = $_SERVER['REQUEST_METHOD'];

if (
    $uri === '/dashboard' ||
    $uri === '/mahasiswa' ||
    $uri === '/mahasiswa/create' ||
    $uri === '/mahasiswa/edit' ||
    $uri === '/mahasiswa/store' ||
    $uri === '/mahasiswa/update' ||
    $uri === '/mahasiswa/delete'
) {
    require_once '../app/Core/Middleware/AuthMiddleware.php';

    $middleware = new AuthMiddleware();
    $middleware->handle();
}

    // Routing
    if (isset($routes[$method][$uri])) {
        [$controllerName, $action] = $routes[$method][$uri];

        require_once "../app/Controllers/$controllerName.php";

        if ($controllerName === 'MahasiswaController') {
            require_once '../app/Core/Database.php';
            require_once '../app/Repositories/MahasiswaRepository.php';
            require_once '../app/Services/MahasiswaService.php';

            $database = Database::getInstance();
            $repository = new MahasiswaRepository($database);
            $service = new MahasiswaService($repository);

            $controller = new MahasiswaController(
                $repository,
                $service
            );
        } else {
            $controller = new $controllerName();
        }

        $controller->$action();

    } elseif (preg_match('#^/mahasiswa/([0-9]+)$#', $uri, $matches)) {
        http_response_code(404);
        echo '<h1>404 - Halaman tidak ditemukan</h1>';

    } else {
        http_response_code(404);
        echo '<h1>404 - Halaman tidak ditemukan</h1>';
    }

} catch (Throwable $e) {
    // Simpan detail error untuk pemeriksaan pengembang
    $logDir = __DIR__ . '/../storage/logs';

    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }

    error_log(
        date('Y-m-d H:i:s') . ' - ' .
        $e . PHP_EOL,
        3,
        $logDir . '/app.log'
    );

    // Tampilkan pesan aman kepada pengguna
    http_response_code(500);
    echo '<h1>Terjadi Kesalahan</h1>';
    echo '<p>Maaf, permintaan belum dapat diproses. Silakan coba kembali.</p>';
}