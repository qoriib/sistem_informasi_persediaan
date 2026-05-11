<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\User;
use App\Models\Barang;
class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $barang = Barang::first();
        $penjualan = Penjualan::create([
            'user_id' => $user->id,
            'tanggal' => now()->subDays(2)->format('Y-m-d'),
        ]);
        PenjualanDetail::create([
            'penjualan_id' => $penjualan->id,
            'barang_id' => $barang->id,
            'jumlah' => 2,
            'harga' => 50000,
        ]);
    }
}
