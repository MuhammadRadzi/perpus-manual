<?php

namespace App;
use PDO;

class Buku {
    public function __construct(
        private PDO $db
    ) {}

    public function semua() {
        $stmt = $this->db->query(
            "SELECT * FROM buku ORDER BY judul"
        );

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

    // public function bukuAndrea() {
    //     $stmt = $this->db->query(
    //         "SELECT * FROM buku WHERE penulis = 'Andrea Hirata' ORDER BY judul"
    //     );

    //     return $stmt->fetchAll(
    //         PDO::FETCH_ASSOC
    //     );
    // }

    public function tambah (string $judul, string $penulis, int $tahun, int $stok) {
        $stmt = $this->db->prepare(
            "INSERT INTO buku (judul, penulis, tahun, stok) VALUES (?,?,?,?)"
        );

        $stmt->execute(
            [$judul, $penulis, $tahun, $stok]
        );
    }

    public function ubah (int $id, string $judul, string $penulis, int $tahun, int $stok) {
        $stmt = $this->db->prepare(
            "UPDATE buku SET judul=?, penulis=?, tahun=?, stok=? WHERE id=?"
        );

        $stmt->execute(
            [$judul, $penulis, $tahun, $stok, $id]
        );
    }

    public function cariBuku (int $id) {
        $stmt = $this->db->prepare(
            "SELECT * FROM buku WHERE id=?"
        );

        $stmt->execute([$id]);

        $buku = $stmt->fetch(PDO::FETCH_ASSOC);
        return $buku ?: null;
    }
}