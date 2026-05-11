<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use App\Models\Pembelian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $totalPenjualan = Penjualan::count();
        $totalPembelian = Pembelian::count();
        $barangHabis = Barang::whereColumn('stok', '<=', 'rop')->get();
        $topBarang = Barang::orderBy('stok')->limit(5)->get();
        $topBarangLabels = $topBarang->pluck('nama');
        $topBarangStok = $topBarang->pluck('stok');
        return view('dashboard', compact('totalBarang', 'totalPenjualan', 'totalPembelian', 'barangHabis', 'topBarangLabels', 'topBarangStok'));
    }

}
