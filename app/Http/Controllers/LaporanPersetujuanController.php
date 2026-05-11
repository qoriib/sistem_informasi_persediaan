<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanPersetujuanController extends Controller
{
    public function index()
    {
        // Get all purchase transactions for approval report
        $pembelians = Pembelian::with('user', 'details.barang', 'approver')
            ->orderBy('tanggal', 'desc')
            ->paginate(15);

        // Summary statistics
        $totalPembelian = Pembelian::count();
        $totalItemPembelian = Pembelian::join('pembelian_details', 'pembelians.id', '=', 'pembelian_details.pembelian_id')
            ->sum('pembelian_details.jumlah');
        $pendingPembelian = Pembelian::where('status', 'pending')->count();

        return view('laporan-persetujuan.index', compact('pembelians', 'totalPembelian', 'totalItemPembelian', 'pendingPembelian'));
    }

    /**
     * Get pembelian data for AJAX
     */
    public function getData($id)
    {
        $pembelian = Pembelian::with('user')->findOrFail($id);
        return response()->json($pembelian);
    }

    /**
     * Approve or reject a purchase
     */
    public function approve(Request $request, Pembelian $pembelian)
    {


        $request->validate([
            'status' => 'required|in:diproses,diterima,ditolak',
            'notes' => 'nullable|string|max:500'
        ]);

        $pembelian->update([
            'status' => $request->status,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'notes' => $request->notes
        ]);

        return redirect()->route('laporan-persetujuan.index')
            ->with('success', 'Status pembelian berhasil diperbarui menjadi ' . $request->status);
    }
}