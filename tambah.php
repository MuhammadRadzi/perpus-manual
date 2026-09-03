<?php

require_once __DIR__ . '/vendor/autoload.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $tahun = (int)$_POST['tahun'];
    $stok = (int)$_POST['stok'];

    $buku->tambah($judul, $penulis, $tahun, $stok);

    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Perpus Manual</title>
</head>
<body>
    <h1>Tambah Buku</h1>
    <form method="POST">
        <label for="judul">Judul</label>
        <input type="text" name="judul" id="judul" required>

        <label for="penulis">Penulis</label>
        <input type="text" name="penulis" id="penulis" required>

        <label for="tahun">Tahun</label>
        <input type="number" name="tahun" id="tahun" required>

        <label for="stok">Stok</label>
        <input type="number" name="stok" id="stok" required>

        <button type="submit">Tambah</button>
    </form>
</body>
</html>