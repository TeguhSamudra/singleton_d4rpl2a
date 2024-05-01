<?php

require_once 'Database.php';

class Motor
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    // Metode untuk menambahkan motor baru
    public function addMotor($nama, $merk, $harga)
    {
        $query = "INSERT INTO motor (nama, merk, harga) VALUES (:nama, :merk, :harga)";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':merk', $merk);
        $stmt->bindParam(':harga', $harga);
        $stmt->execute();
    }

    // Metode untuk mengambil semua data motor
    public function getAllMotor()
    {
        $query = "SELECT * FROM motor";
        $stmt = $this->db->getConnection()->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metode untuk menghapus motor berdasarkan ID
    public function deleteMotor($id)
    {
        $query = "DELETE FROM motor WHERE id = :id";
        $stmt = $this->db->getConnection()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>
