<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;
class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        KategoriBarang::insert([
            ['nama' => 'Elektrikal'],
            ['nama' => 'Mekanik'],
            ['nama' => 'Body'],
            ['nama' => 'Oli & Cairan'],
            ['nama' => 'Aksesoris'],
        ]);
    }
}
