<?php

require_once __DIR__ . '/src/Models/Motor.php';
require_once __DIR__ . '/src/Models/Mobil.php';
require_once __DIR__ . '/src/Storage/StorageManager.php';


$storage = new StorageManager();


$motorSaya = new Motor('Honda', 'Vario 160', 2024, 'Matic');
$motorSaya->inisialisasiKomponenDefault('2026-10-15');
$storage->simpanData($motorSaya);


$mobilSaya = new Mobil('Toyota', 'Avanza', 2023, '1500cc');
$mobilSaya->inisialisasiKomponenDefault('2026-09-01');
$storage->simpanData($mobilSaya);


$dataTersimpan = $storage->ambilSemuaData();

echo "<h2>Uji Coba Kerangka OOP - Sistem Perawatan Kendaraan</h2>";
foreach ($dataTersimpan as $item) {
    echo "<h3>{$item['jenis']}: {$item['merk']} {$item['tipe']} ({$item['tahun']})</h3>";
    echo "<ul>";
    foreach ($item['daftarKomponen'] as $komp) {
        echo "<li><strong>{$komp['namaKomponen']}</strong> | Interval: {$komp['intervalBulan']} bln | Tenggat: {$komp['tenggatBerikutnya']} | Status: <em>{$komp['status']}</em> | Est. Biaya: Rp " . number_format($komp['estimasiBiaya'], 0, ',', '.') . "</li>";
    }
    echo "</ul>";
    echo "<p><strong>Total Estimasi Biaya Siklus Penuh:</strong> Rp " . number_format($item['totalEstimasiBiaya'], 0, ',', '.') . "</p><hr>";
}