<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'tanggal', 'deskripsi', 'keterangan', 'file_path', 'status', 'approved_at', 'approved_by', 'notes'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function details()
    {
        return $this->hasMany(PembelianDetail::class);
    }

    /**
     * Get status badge color
     */
    public function getStatusColor()
    {
        return match ($this->status) {
            'pending' => 'yellow',
            'diproses' => 'blue',
            'diterima' => 'green',
            'ditolak' => 'red',
            default => 'gray'
        };
    }
}
