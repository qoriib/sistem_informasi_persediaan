<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'nama', 'kategori_barang_id', 'stok', 'rop'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
    /**
     * Hitung ROP (Reorder Point) berdasarkan parameter sederhana
     * ROP = (lead time x rata-rata penjualan harian) + safety stock
     */
    public function hitungROP($leadTimeHari = 3, $safetyStock = 5)
    {
        // Ambil rata-rata penjualan harian 30 hari terakhir
        $rataPenjualan = $this->penjualanRataHarian(30);
        return ($leadTimeHari * $rataPenjualan) + $safetyStock;
    }

    /**
     * Hitung rata-rata penjualan harian untuk barang ini
     */
    public function penjualanRataHarian($hari = 30)
    {
        $from = now()->subDays($hari);
        $jumlah = $this->penjualanDetails()
            ->whereHas('penjualan', function ($q) use ($from) {
                $q->where('tanggal', '>=', $from);
            })
            ->sum('jumlah');
        return $hari > 0 ? round($jumlah / $hari, 2) : 0;
    }

    public function penjualanDetails()
    {
        return $this->hasMany('App\Models\PenjualanDetail', 'barang_id');
    }


}
