<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\Database;
use App\Buku;

$database = new Database(
    "localhost",
    "pustaka-manual",
    "root",
    ""
);

$db = $database->connect();

$buku = new Buku($db);

$semuaBuku = $buku->semua();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpus Manual</title>
</head>
<body>
    <h1>Perpustakaan</h1>
    <p>
        <a href="tambah.php">Tambah Buku</a> | 
        <a href="anggota.php">Manajemen Anggota</a>
    </p>

    <h2>Daftar Buku</h2>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($semuaBuku as $b): ?>
                <tr>
                    <td><?= htmlspecialchars($b['id']) ?></td>
                    <td><?= htmlspecialchars($b['judul']) ?></td>
                    <td><?= htmlspecialchars($b['penulis']) ?></td>
                    <td><?= htmlspecialchars($b['tahun']) ?></td>
                    <td><?= htmlspecialchars($b['stok']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
