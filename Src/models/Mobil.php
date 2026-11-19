<?php

require_once __DIR__ . '/Kendaraan.php';

class Mobil extends Kendaraan
{
    private string $kapasitasMesin; // Contoh: 1500cc

    public function __construct(string $merk, string $tipe, int $tahun, string $kapasitasMesin = '1500cc', ?string $id = null)
    {
        parent::__construct($merk, $tipe, $tahun, $id);
        $this->jenis = 'Mobil';
        $this->kapasitasMesin = $kapasitasMesin;
    }

    public function inisialisasiKomponenDefault(string $tanggalAwal): void
    {
        $this->daftarKomponen = [];
        $this->tambahKomponen(new KomponenPerawatan('Oli Mesin (4 Liter)', 3, $tanggalAwal, 380000));
        $this->tambahKomponen(new KomponenPerawatan('Filter Oli', 6, $tanggalAwal, 65000));
        $this->tambahKomponen(new KomponenPerawatan('Filter Udara', 12, $tanggalAwal, 140000));
        $this->tambahKomponen(new KomponenPerawatan('Minyak Rem', 12, $tanggalAwal, 95000));
    }

    public function getKapasitasMesin(): string
    {
        return $this->kapasitasMesin;
    }
}