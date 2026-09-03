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

if ($id <= 0) {
    die('ID anggota tidak valid');
}

$anggota->hapus($id);

header('Location: anggota.php');
exit;
