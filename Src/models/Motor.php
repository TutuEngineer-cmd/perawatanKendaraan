<?php

require_once __DIR__ . '/Kendaraan.php';

class Motor extends Kendaraan
{
    private string $jenisTransmisi; // Contoh: Matic / Manual

    public function __construct(string $merk, string $tipe, int $tahun, string $jenisTransmisi = 'Matic', ?string $id = null)
    {
        parent::__construct($merk, $tipe, $tahun, $id);
        $this->jenis = 'Motor';
        $this->jenisTransmisi = $jenisTransmisi;
    }

    public function inisialisasiKomponenDefault(string $tanggalAwal): void
    {
        $this->daftarKomponen = [];
        $this->tambahKomponen(new KomponenPerawatan('Oli Mesin', 1, $tanggalAwal, 65000));
        $this->tambahKomponen(new KomponenPerawatan('Oli Gardan', 3, $tanggalAwal, 25000));
        $this->tambahKomponen(new KomponenPerawatan('Filter Udara', 12, $tanggalAwal, 55000));
        $this->tambahKomponen(new KomponenPerawatan('Minyak Rem', 12, $tanggalAwal, 35000));
    }

    public function getJenisTransmisi(): string
    {
        return $this->jenisTransmisi;
    }
}