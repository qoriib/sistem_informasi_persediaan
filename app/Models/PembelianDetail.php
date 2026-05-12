<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory;
    protected $fillable = ['pembelian_id', 'barang_id', 'jumlah', 'harga'];
    
    protected static function booted()
    {
        static::saved(function ($detail) {
            $detail->barang->recalculateRop();
        });
        static::deleted(function ($detail) {
            $detail->barang->recalculateRop();
        });
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
