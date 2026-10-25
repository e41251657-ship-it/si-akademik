
<?php

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

            $this->connection = new PDO(
                $dsn,
                $config['username'],
                $config['password'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $e) {
            $logDir = __DIR__ . '/../../storage/logs';

            if (!is_dir($logDir)) {
                mkdir($logDir, 0755, true);
            }

            error_log(
                date('Y-m-d H:i:s') . ' - Koneksi database gagal: ' .
                $e->getMessage() . PHP_EOL,
                3,
                $logDir . '/app.log'
            );

            throw new RuntimeException(
                'Koneksi database gagal.',
                0,
                $e
            );
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
