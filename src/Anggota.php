<?php

namespace App;

use PDO;

class Anggota
{
    public function __construct(
        private PDO $db
    ) {}

    public function semua()
    {
        $stmt = $this->db->query(
            "SELECT * FROM anggota ORDER BY tanggal_daftar DESC, id DESC"
        );

        return $stmt->fetchAll(
            PDO::FETCH_ASSOC
        );
    }

    public function tambah(string $nama_lengkap, string $nis_nik, string $jenis_kelamin, string $alamat, string $no_telepon, string $tanggal_daftar)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO anggota (nama_lengkap, nis_nik, jenis_kelamin, alamat, no_telepon, tanggal_daftar) VALUES (?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $nama_lengkap,
            $nis_nik,
            $jenis_kelamin,
            $alamat,
            $no_telepon,
            $tanggal_daftar
        ]);
    }

    public function cekNisNik(string $nis_nik)
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM anggota WHERE nis_nik = ?"
        );
        $stmt->execute([$nis_nik]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
