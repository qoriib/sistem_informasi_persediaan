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
        $user = User::where('role', 'admin_sparepart')->first() ?? User::first();
        $barangByKode = Barang::pluck('id', 'kode');

        $data = [
            'EL001' => [
                'harga' => 42000,
                'orders' => [
                    ['days' => 120, 'qty' => 40],
                    ['days' => 90, 'qty' => 35],
                    ['days' => 60, 'qty' => 30],
                    ['days' => 28, 'qty' => 25],
                    ['days' => 18, 'qty' => 20],
                    ['days' => 9, 'qty' => 15],
                ],
            ],
            'ME001' => [
                'harga' => 38000,
                'orders' => [
                    ['days' => 150, 'qty' => 30],
                    ['days' => 100, 'qty' => 28],
                    ['days' => 70, 'qty' => 25],
                    ['days' => 26, 'qty' => 20],
                    ['days' => 14, 'qty' => 18],
                    ['days' => 6, 'qty' => 15],
                ],
            ],
            'BD001' => [
                'harga' => 25000,
                'orders' => [
                    ['days' => 140, 'qty' => 20],
                    ['days' => 95, 'qty' => 18],
                    ['days' => 62, 'qty' => 16],
                    ['days' => 27, 'qty' => 14],
                    ['days' => 13, 'qty' => 12],
                    ['days' => 4, 'qty' => 10],
                ],
            ],
            'OL001' => [
                'harga' => 32000,
                'orders' => [
                    ['days' => 160, 'qty' => 50],
                    ['days' => 110, 'qty' => 45],
                    ['days' => 75, 'qty' => 40],
                    ['days' => 29, 'qty' => 35],
                    ['days' => 16, 'qty' => 30],
                    ['days' => 8, 'qty' => 25],
                ],
            ],
            'AK001' => [
                'harga' => 18000,
                'orders' => [
                    ['days' => 130, 'qty' => 15],
                    ['days' => 88, 'qty' => 14],
                    ['days' => 55, 'qty' => 13],
                    ['days' => 24, 'qty' => 12],
                    ['days' => 11, 'qty' => 10],
                    ['days' => 3, 'qty' => 9],
                ],
            ],
        ];

        foreach ($data as $kode => $detail) {
            $barangId = $barangByKode[$kode] ?? null;
            if (!$barangId) {
                continue;
            }

            foreach ($detail['orders'] as $order) {
                $tanggal = now()->subDays($order['days'])->format('Y-m-d');
                $pembelian = Pembelian::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                    'status' => 'diterima',
                    'approved_at' => now()->subDays(max($order['days'] - 1, 0)),
                    'approved_by' => $user->id,
                    'notes' => 'Seeded order for ROP simulation',
                ]);

                PembelianDetail::create([
                    'pembelian_id' => $pembelian->id,
                    'barang_id' => $barangId,
                    'jumlah' => $order['qty'],
                    'harga' => $detail['harga'],
                ]);
            }
        }
    }
}
