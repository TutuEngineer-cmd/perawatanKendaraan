<?php

require_once __DIR__ . '/../Models/Kendaraan.php';

class StorageManager
{
    private string $filePath;

    public function __construct(string $filePath = __DIR__ . '/../../storage/data_kendaraan.json')
    {
        $this->filePath = $filePath;
        $folder = dirname($this->filePath);

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        if (!file_exists($this->filePath)) {
            file_put_contents($this->filePath, json_encode([]));
        }
    }

    public function simpanData(Kendaraan $kendaraan): void
    {
        $semuaData = $this->ambilSemuaData();
        $semuaData[$kendaraan->getId()] = $kendaraan->toArray();

        file_put_contents(
            $this->filePath,
            json_encode($semuaData, JSON_PRETTY_PRINT)
        );
    }

    public function ambilSemuaData(): array
    {
        $konten = file_get_contents($this->filePath);
        return json_decode($konten, true) ?? [];
    }

    public function hapusData(string $idKendaraan): void
    {
        $semuaData = $this->ambilSemuaData();
        if (isset($semuaData[$idKendaraan])) {
            unset($semuaData[$idKendaraan]);
            file_put_contents(
                $this->filePath,
                json_encode($semuaData, JSON_PRETTY_PRINT)
            );
        }
    }
}