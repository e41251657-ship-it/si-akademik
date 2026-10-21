<?php

class Model
{
    protected $db;

    public function __construct()
    {
        $config = require '../config/database.php';

        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";

        $this->db = new PDO(
            $dsn,
            $config['username'],
            $config['password']
        );
    }
}