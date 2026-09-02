<?php


namespace App;
use PDOException;
use PDO;

class Database {
    public function __construct(
        private string $host,
        private string $database,
        private string $username,
        private string $password
    ) {}

    public function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
        try {
            $db = new PDO(
                $dsn,
                $this->username,
                $this->password
            );
            
            $db->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $db;
        } catch (PDOException $error) {
            die("Koneksi Gagal: " . $error->getMessage());
        }
    }
}