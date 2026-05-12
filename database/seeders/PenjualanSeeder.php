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
        $user = User::where('role', 'service_manager')->first() ?? User::first();
        $barangByKode = Barang::pluck('id', 'kode');

        $data = [
            'EL001' => [
                'harga' => 55000,
                'sales' => [
                    ['days' => 330, 'qty' => 12],
                    ['days' => 300, 'qty' => 10],
                    ['days' => 240, 'qty' => 9],
                    ['days' => 180, 'qty' => 11],
                    ['days' => 120, 'qty' => 8],
                    ['days' => 60, 'qty' => 7],
                    ['days' => 20, 'qty' => 6],
                    ['days' => 7, 'qty' => 5],
                ],
            ],
            'ME001' => [
                'harga' => 50000,
                'sales' => [
                    ['days' => 320, 'qty' => 9],
                    ['days' => 270, 'qty' => 8],
                    ['days' => 210, 'qty' => 7],
                    ['days' => 150, 'qty' => 8],
                    ['days' => 100, 'qty' => 6],
                    ['days' => 55, 'qty' => 5],
                    ['days' => 18, 'qty' => 4],
                    ['days' => 5, 'qty' => 3],
                ],
            ],
            'BD001' => [
                'harga' => 35000,
                'sales' => [
                    ['days' => 310, 'qty' => 6],
                    ['days' => 260, 'qty' => 5],
                    ['days' => 200, 'qty' => 5],
                    ['days' => 140, 'qty' => 6],
                    ['days' => 90, 'qty' => 4],
                    ['days' => 45, 'qty' => 4],
                    ['days' => 16, 'qty' => 3],
                    ['days' => 3, 'qty' => 2],
                ],
            ],
            'OL001' => [
                'harga' => 40000,
                'sales' => [
                    ['days' => 340, 'qty' => 15],
                    ['days' => 280, 'qty' => 13],
                    ['days' => 220, 'qty' => 12],
                    ['days' => 160, 'qty' => 10],
                    ['days' => 110, 'qty' => 9],
                    ['days' => 65, 'qty' => 8],
                    ['days' => 22, 'qty' => 7],
                    ['days' => 9, 'qty' => 6],
                ],
            ],
            'AK001' => [
                'harga' => 25000,
                'sales' => [
                    ['days' => 300, 'qty' => 4],
                    ['days' => 240, 'qty' => 4],
                    ['days' => 190, 'qty' => 3],
                    ['days' => 130, 'qty' => 4],
                    ['days' => 85, 'qty' => 3],
                    ['days' => 48, 'qty' => 3],
                    ['days' => 19, 'qty' => 2],
                    ['days' => 6, 'qty' => 2],
                ],
            ],
        ];

        foreach ($data as $kode => $detail) {
            $barangId = $barangByKode[$kode] ?? null;
            if (!$barangId) {
                continue;
            }

            foreach ($detail['sales'] as $sale) {
                $tanggal = now()->subDays($sale['days'])->format('Y-m-d');
                $penjualan = Penjualan::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                ]);

                PenjualanDetail::create([
                    'penjualan_id' => $penjualan->id,
                    'barang_id' => $barangId,
                    'jumlah' => $sale['qty'],
                    'harga' => $detail['harga'],
                ]);
            }
        }
    }
}
