<?php

namespace App\Http\Controllers;


use App\Models\Penjualan;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['user', 'details.barang'])->orderByDesc('tanggal')->get();
        return view('penjualan.index', compact('penjualans'));
    }
    public function create()
    {
        $barangs = Barang::all();
        return view('penjualan.create', compact('barangs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|string',
        ]);
        $jumlahArr = array_map('intval', explode(',', $request->jumlah));
        if (count($jumlahArr) !== count($request->barang_id)) {
            return back()->withErrors(['jumlah' => 'Jumlah barang tidak sesuai pilihan.']);
        }
        $penjualan = Penjualan::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
        ]);
        foreach ($request->barang_id as $i => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = $jumlahArr[$i];
            $harga = 0; // Set harga sesuai kebutuhan
            $penjualan->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $qty,
                'harga' => $harga,
            ]);
            $barang->decrement('stok', $qty);
        }
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan');
    }
    public function show($id)
    {
        $penjualan = Penjualan::with(['user', 'details.barang'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }
    public function edit($id)
    {
        $penjualan = Penjualan::with(['details.barang'])->findOrFail($id);
        $barangs = Barang::all();
        return view('penjualan.edit', compact('penjualan', 'barangs'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|string',
        ]);

        $penjualan = Penjualan::with(['details'])->findOrFail($id);
        $jumlahArr = array_map('intval', explode(',', $request->jumlah));

        if (count($jumlahArr) !== count($request->barang_id)) {
            return back()->withErrors(['jumlah' => 'Jumlah barang tidak sesuai pilihan.']);
        }

        // Revert stok dari detail lama
        foreach ($penjualan->details as $detail) {
            $detail->barang->increment('stok', $detail->jumlah);
        }

        // Hapus detail lama dan buat yang baru
        $penjualan->details()->delete();
        $penjualan->update(['tanggal' => $request->tanggal]);

        // Tambah detail baru dan update stok
        foreach ($request->barang_id as $i => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = $jumlahArr[$i];
            $harga = 0;
            $penjualan->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $qty,
                'harga' => $harga,
            ]);
            $barang->decrement('stok', $qty);
        }

        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil diperbarui');
    }
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        foreach ($penjualan->details as $detail) {
            $detail->barang->increment('stok', $detail->jumlah);
        }
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus');
    }

    public function exportPdf()
    {
        $penjualans = Penjualan::with(['user', 'details.barang'])->orderByDesc('tanggal')->get();
        $generatedAt = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('exports.penjualan', compact('penjualans', 'generatedAt'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('penjualan-' . now()->format('Ymd_His') . '.pdf');
    }
}
