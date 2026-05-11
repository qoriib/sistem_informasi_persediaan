<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['kode', 'nama', 'kategori_barang_id', 'stok', 'rop'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_barang_id');
    }
    public function pembelianDetails()
    {
        return $this->hasMany(PembelianDetail::class, 'barang_id');
    }

    public function penjualanDetails()
    {
        return $this->hasMany(PenjualanDetail::class, 'barang_id');
    }

    public function usagePerHari(int $workingDays = 365): float
    {
        $from = now()->subDays($workingDays);
        if ($this->relationLoaded('penjualanDetails')) {
            $total = $this->penjualanDetails
                ->filter(function ($detail) use ($from) {
                    return $detail->penjualan && Carbon::parse($detail->penjualan->tanggal)->gte($from);
                })
                ->sum('jumlah');
        } else {
            $total = $this->penjualanDetails()
                ->whereHas('penjualan', function ($q) use ($from) {
                    $q->where('tanggal', '>=', $from);
                })
                ->sum('jumlah');
        }

        return $workingDays > 0 ? $total / $workingDays : 0.0;
    }

    public function periodeBarangDatang(): float
    {
        if ($this->relationLoaded('pembelianDetails')) {
            $tanggal = $this->pembelianDetails
                ->pluck('pembelian.tanggal')
                ->filter()
                ->unique()
                ->sort()
                ->values();
        } else {
            $tanggal = $this->pembelianDetails()
                ->with('pembelian:id,tanggal')
                ->get()
                ->pluck('pembelian.tanggal')
                ->filter()
                ->unique()
                ->sort()
                ->values();
        }

        if ($tanggal->count() < 2) {
            return 0.0;
        }

        $totalDiff = 0;
        for ($i = 1; $i < $tanggal->count(); $i++) {
            $prev = Carbon::parse($tanggal[$i - 1]);
            $curr = Carbon::parse($tanggal[$i]);
            $totalDiff += $prev->diffInDays($curr);
        }

        return $totalDiff / max($tanggal->count() - 1, 1);
    }

    public function frekuensiOrderPerBulan(int $days = 30): int
    {
        $from = now()->subDays($days);
        if ($this->relationLoaded('pembelianDetails')) {
            return $this->pembelianDetails
                ->filter(function ($detail) use ($from) {
                    return $detail->pembelian && Carbon::parse($detail->pembelian->tanggal)->gte($from);
                })
                ->pluck('pembelian_id')
                ->unique()
                ->count();
        }

        return $this->pembelianDetails()
            ->whereHas('pembelian', function ($q) use ($from) {
                $q->where('tanggal', '>=', $from);
            })
            ->distinct('pembelian_id')
            ->count('pembelian_id');
    }

    public function ropComponents(int $workingDays = 365, int $monthDays = 30): array
    {
        $usage = $this->usagePerHari($workingDays);
        $periodeDatang = $this->periodeBarangDatang();
        $frekuensiOrder = $this->frekuensiOrderPerBulan($monthDays);
        $leadTime = $frekuensiOrder > 0 ? $periodeDatang / $frekuensiOrder : 0.0;
        $safetyStock = $frekuensiOrder > 0 ? $this->stok / $frekuensiOrder : 0.0;

        return [
            'usage' => $usage,
            'lead_time' => $leadTime,
            'safety_stock' => $safetyStock,
        ];
    }

    public function recalculateRop(int $workingDays = 365, int $monthDays = 30): int
    {
        $components = $this->ropComponents($workingDays, $monthDays);
        $leadTime = $components['lead_time'];
        $safetyStock = $components['safety_stock'];
        $usage = $components['usage'];
        $rop = ($usage * $leadTime) + $safetyStock;

        $this->rop = (int) ceil($rop);
        $this->save();

        return $this->rop;
    }

}
