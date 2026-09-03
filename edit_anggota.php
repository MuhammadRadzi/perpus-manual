<?php

require_once __DIR__ . '/vendor/autoload.php';

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

$id = (int) ($_GET['id'] ?? 0);
$error = '';

if ($id <= 0) {
    die('ID anggota tidak valid');
}

$dataAnggota = $anggota->cariAnggota($id);

if (!$dataAnggota) {
    die('Anggota tidak ditemukan');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_lengkap   = trim($_POST['nama_lengkap'] ?? '');
    $nis_nik        = trim($_POST['nis_nik'] ?? '');
    $jenis_kelamin  = trim($_POST['jenis_kelamin'] ?? '');
    $alamat         = trim($_POST['alamat'] ?? '');
    $no_telepon     = trim($_POST['no_telepon'] ?? '');
    $tanggal_daftar = trim($_POST['tanggal_daftar'] ?? '');

    if (empty($nama_lengkap) || empty($nis_nik) || empty($jenis_kelamin) || empty($alamat) || empty($no_telepon) || empty($tanggal_daftar)) {
        $error = 'Semua field wajib diisi!';
    } else {
        $existing = $anggota->cekNisNik($nis_nik, $id);
        if ($existing) {
            $error = 'NIS/NIK tersebut sudah terdaftar oleh anggota lain!';
        } else {
            $anggota->ubah($id, $nama_lengkap, $nis_nik, $jenis_kelamin, $alamat, $no_telepon, $tanggal_daftar);
            header('Location: anggota.php');
            exit;
        }
    }
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
    <title>Edit Anggota - Perpus Manual</title>
</head>

<body>
    <h1>Edit Anggota: <?= htmlspecialchars($dataAnggota['nama_lengkap']) ?></h1>
    <p>
        <a href="anggota.php">&larr; Kembali ke Daftar Anggota</a>
    </p>

    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div>
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= htmlspecialchars($_POST['nama_lengkap'] ?? $dataAnggota['nama_lengkap']) ?>" required>
        </div>

        <div>
            <label for="nis_nik">NIS / NIK</label>
            <input type="text" name="nis_nik" id="nis_nik" value="<?= htmlspecialchars($_POST['nis_nik'] ?? $dataAnggota['nis_nik']) ?>" required>
        </div>

        <div>
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <?php $jk = $_POST['jenis_kelamin'] ?? $dataAnggota['jenis_kelamin']; ?>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L" <?= $jk === 'L' ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= $jk === 'P' ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>

        <div>
            <label for="alamat">Alamat</label>
            <textarea name="alamat" id="alamat" required><?= htmlspecialchars($_POST['alamat'] ?? $dataAnggota['alamat']) ?></textarea>
        </div>

        <div>
            <label for="no_telepon">No. Telepon</label>
            <input type="text" name="no_telepon" id="no_telepon" value="<?= htmlspecialchars($_POST['no_telepon'] ?? $dataAnggota['no_telepon']) ?>" required>
        </div>

        <div>
            <label for="tanggal_daftar">Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" id="tanggal_daftar" value="<?= htmlspecialchars($_POST['tanggal_daftar'] ?? $dataAnggota['tanggal_daftar']) ?>" required>
        </div>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>

</html>
