<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{
    use HasFactory;
    protected $fillable = ['penjualan_id', 'barang_id', 'jumlah', 'harga'];
    
    protected static function booted()
    {
        static::saved(function ($detail) {
            $detail->barang->recalculateRop();
        });
        static::deleted(function ($detail) {
            $detail->barang->recalculateRop();
        });
    }

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
