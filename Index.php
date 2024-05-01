<?php
require_once 'Motor.php';

// Membuat objek Motor (transaksi database)
$motorManager = new Motor();

// Jika form disubmit untuk menambahkan Motor baru
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $merk = $_POST['merk'];
    $harga = $_POST['harga'];
    $motorManager->addMotor($nama, $merk, $harga);
}

// Jika terdapat parameter delete dalam URL
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];
    $motorManager->deleteMotor($deleteId);
}

// Tampilkan tabel data Motor
$MotorList = $motorManager->getAllMotor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Motor Data</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Motor Data</h2>
    <form action="" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        <label for="merk">Merk:</label>
        <input type="text" id="merk" name="merk" required>
        <label for="harga">Harga:</label>
        <input type="number" id="harga" name="harga" required>
        <button type="submit">Tambah Motor</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Merk</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php foreach ($MotorList as $motor) : ?>
            <tr>
                <td><?php echo $motor['id']; ?></td>
                <td><?php echo $motor['nama']; ?></td>
                <td><?php echo $motor['merk']; ?></td>
                <td><?php echo $motor['harga']; ?></td>
                <td><a href="?delete=<?php echo $motor['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus motor ini?')">Hapus</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
