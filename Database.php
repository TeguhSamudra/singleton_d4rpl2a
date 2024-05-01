<?php

class Database
{
    private static $instance = null;
    private $conn;

    private $host = 'localhost';
    private $username = 'root';
    private $password = ''; // Sebaiknya diganti dengan cara yang lebih aman
    private $database = 'Dealer';

    // Constructor sekarang private agar kelas lain tidak bisa membuat instance secara langsung
    private function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // Penanganan kesalahan: catat pesan kesalahan atau lemparkan kembali pengecualian
            throw new Exception("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

?>
