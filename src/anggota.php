<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../vendor/autoload.php";

use App\Database;
use App\Anggota;

$database = new Database(
    "localhost",
    "pustaka-manual",
    "root",
    ""
);

$db = $database->connect();
$anggota = new Anggota($db);
$semuaAnggota = $anggota->semua();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/numen111104/nide-ui-default@v1.0.0/css/default-ui.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;500;700;800&display=swap">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota - Perpus Manual</title>
</head>

<body>
    <h1>Manajemen Anggota Perpustakaan</h1>
    <p>
        <a href="index.php">&larr; Kembali ke Beranda</a> |
        <a href="tambah_anggota.php">+ Tambah Anggota</a>
    </p>

    <h2>Daftar Anggota</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>NIS/NIK</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>No. Telepon</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($semuaAnggota)): ?>
                <tr>
                    <td colspan="7" style="text-align: center;">Belum ada data anggota.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($semuaAnggota as $a): ?>
                    <tr>
                        <td><?= htmlspecialchars($a['id']) ?></td>
                        <td><?= htmlspecialchars($a['nama_lengkap']) ?></td>
                        <td><?= htmlspecialchars($a['nis_nik']) ?></td>
                        <td><?= $a['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= htmlspecialchars($a['alamat']) ?></td>
                        <td><?= htmlspecialchars($a['no_telepon']) ?></td>
                        <td><?= htmlspecialchars($a['tanggal_daftar']) ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>