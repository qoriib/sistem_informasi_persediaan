<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;
use App\Models\KategoriBarang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = KategoriBarang::pluck('id', 'nama');

        $data = [
            ['kode' => 'EL001', 'nama' => 'Baterai', 'kategori_barang_id' => $kategori['Elektrikal'] ?? 1, 'stok' => 50],
            ['kode' => 'ME001', 'nama' => 'Kampas Rem', 'kategori_barang_id' => $kategori['Mekanik'] ?? 2, 'stok' => 30],
            ['kode' => 'BD001', 'nama' => 'Spion', 'kategori_barang_id' => $kategori['Body'] ?? 3, 'stok' => 20],
            ['kode' => 'OL001', 'nama' => 'Oli Mesin', 'kategori_barang_id' => $kategori['Oli & Cairan'] ?? 4, 'stok' => 40],
            ['kode' => 'AK001', 'nama' => 'Karpet Mobil', 'kategori_barang_id' => $kategori['Aksesoris'] ?? 5, 'stok' => 15],
        ];

        foreach ($data as $item) {
            // Gunakan create() agar memicu recalculateRop() secara otomatis
            Barang::create($item);
        }
    }
}
