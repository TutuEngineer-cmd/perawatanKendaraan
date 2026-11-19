<?php

require_once __DIR__ . '/KomponenPerawatan.php';

abstract class Kendaraan
{
    protected string $id;
    protected string $jenis;
    protected string $merk;
    protected string $tipe;
    protected int $tahun;
    /** @var KomponenPerawatan[] */
    protected array $daftarKomponen = [];

    public function __construct(string $merk, string $tipe, int $tahun, ?string $id = null)
    {
        $this->id = $id ?? uniqid('knd_');
        $this->merk = $merk;
        $this->tipe = $tipe;
        $this->tahun = $tahun;
    }

    
    abstract public function inisialisasiKomponenDefault(string $tanggalAwal): void;

    public function tambahKomponen(KomponenPerawatan $komponen): void
    {
        $this->daftarKomponen[] = $komponen;
    }

    public function hitungTotalEstimasiBiaya(): int
    {
        $total = 0;
        foreach ($this->daftarKomponen as $komponen) {
            $total += $komponen->getEstimasiBiaya();
        }
        return $total;
    }

    public function getId(): string { return $this->id; }
    public function getJenis(): string { return $this->jenis; }
    public function getMerk(): string { return $this->merk; }
    public function getTipe(): string { return $this->tipe; }
    public function getTahun(): int { return $this->tahun; }

    /** @return KomponenPerawatan[] */
    public function getDaftarKomponen(): array { return $this->daftarKomponen; }

    public function toArray(): array
    {
        $komponenArray = array_map(fn($k) => $k->toArray(), $this->daftarKomponen);

        return [
            'id' => $this->id,
            'jenis' => $this->jenis,
            'merk' => $this->merk,
            'tipe' => $this->tipe,
            'tahun' => $this->tahun,
            'totalEstimasiBiaya' => $this->hitungTotalEstimasiBiaya(),
            'daftarKomponen' => $komponenArray,
        ];
    }
}