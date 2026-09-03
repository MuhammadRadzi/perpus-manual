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

    public function ubah(int $id, string $nama_lengkap, string $nis_nik, string $jenis_kelamin, string $alamat, string $no_telepon, string $tanggal_daftar)
    {
        $stmt = $this->db->prepare(
            "UPDATE anggota SET nama_lengkap=?, nis_nik=?, jenis_kelamin=?, alamat=?, no_telepon=?, tanggal_daftar=? WHERE id=?"
        );

        return $stmt->execute([
            $nama_lengkap,
            $nis_nik,
            $jenis_kelamin,
            $alamat,
            $no_telepon,
            $tanggal_daftar,
            $id
        ]);
    }

    public function cariAnggota(int $id)
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM anggota WHERE id = ?"
        );

        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data ?: null;
    }

    public function hapus(int $id)
    {
        $stmt = $this->db->prepare(
            "DELETE FROM anggota WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }

    public function cekNisNik(string $nis_nik, ?int $excludeId = null)
    {
        if ($excludeId !== null) {
            $stmt = $this->db->prepare(
                "SELECT id FROM anggota WHERE nis_nik = ? AND id != ?"
            );
            $stmt->execute([$nis_nik, $excludeId]);
        } else {
            $stmt = $this->db->prepare(
                "SELECT id FROM anggota WHERE nis_nik = ?"
            );
            $stmt->execute([$nis_nik]);
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
