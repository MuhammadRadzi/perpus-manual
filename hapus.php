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

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    die('ID buku tidak valid');
    exit;
}

$buku->hapus($id);

header('Location: index.php');

?>