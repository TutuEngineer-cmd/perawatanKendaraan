<?php

class KomponenPerawatan
{
    private string $namaKomponen;
    private int $intervalBulan;
    private string $tanggalGantiTerakhir; // Format: YYYY-MM-DD
    private int $estimasiBiaya;

    public function __construct(
        string $namaKomponen,
        int $intervalBulan,
        string $tanggalGantiTerakhir,
        int $estimasiBiaya
    ) {
        $this->namaKomponen = $namaKomponen;
        $this->intervalBulan = $intervalBulan;
        $this->tanggalGantiTerakhir = $tanggalGantiTerakhir;
        $this->estimasiBiaya = $estimasiBiaya;
    }

    // Menghitung tanggal penggantian berikutnya berdasarkan interval bulan
    public function hitungTenggatBerikutnya(): string
    {
        $tanggal = new DateTime($this->tanggalGantiTerakhir);
        $tanggal->modify("+{$this->intervalBulan} months");
        return $tanggal->format('Y-m-d');
    }

    // Mengecek status kelayakan berdasarkan tanggal hari ini
    public function cekStatusKelayakan(): string
    {
        $hariIni = new DateTime();
        $tenggat = new DateTime($this->hitungTenggatBerikutnya());
        $selisihHari = (int) $hariIni->diff($tenggat)->format('%r%a');

        if ($selisihHari < 0) {
            return "Wajib Ganti (Terlewat " . abs($selisihHari) . " hari)";
        } elseif ($selisihHari <= 7) {
            return "Mendekati Tenggat ({$selisihHari} hari lagi)";
        } else {
            return "Aman ({$selisihHari} hari lagi)";
        }
    }

    public function perbaruiTanggalGanti(string $tanggalBaru): void
    {
        $this->tanggalGantiTerakhir = $tanggalBaru;
    }

    // Getter methods (Encapsulation)
    public function getNamaKomponen(): string { return $this->namaKomponen; }
    public function getIntervalBulan(): int { return $this->intervalBulan; }
    public function getTanggalGantiTerakhir(): string { return $this->tanggalGantiTerakhir; }
    public function getEstimasiBiaya(): int { return $this->estimasiBiaya; }

    // Mengubah objek ke array agar mudah disimpan ke JSON
    public function toArray(): array
    {
        return [
            'namaKomponen' => $this->namaKomponen,
            'intervalBulan' => $this->intervalBulan,
            'tanggalGantiTerakhir' => $this->tanggalGantiTerakhir,
            'estimasiBiaya' => $this->estimasiBiaya,
            'tenggatBerikutnya' => $this->hitungTenggatBerikutnya(),
            'status' => $this->cekStatusKelayakan(),
        ];
    }
}