<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../../config/database.php';

        try {

            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

            $this->db = new PDO(
                $dsn,
                $config['username'],
                $config['password']
            );

            $this->db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch (PDOException $e) {

            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}