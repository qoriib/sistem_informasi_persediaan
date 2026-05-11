<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Pembelian;
use App\Models\PembelianDetail;
use App\Models\User;
use App\Models\Barang;
class PembelianSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        $barang = Barang::first();
        $pembelian = Pembelian::create([
            'user_id' => $user->id,
            'tanggal' => now()->subDays(1)->format('Y-m-d'),
        ]);
        PembelianDetail::create([
            'pembelian_id' => $pembelian->id,
            'barang_id' => $barang->id,
            'jumlah' => 5,
            'harga' => 45000,
        ]);
    }
}
