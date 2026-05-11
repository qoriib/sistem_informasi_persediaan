<?php

namespace App\Http\Controllers;


use App\Models\Pembelian;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with(['user', 'details.barang'])->orderByDesc('tanggal')->get();
        return view('pembelian.index', compact('pembelians'));
    }
    public function create()
    {

        $barangs = Barang::all();
        return view('pembelian.create', compact('barangs'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|max:5120|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|string',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('pembelian', 'public');
        }

        $jumlahArr = array_map('intval', explode(',', $request->jumlah));
        if (count($jumlahArr) !== count($request->barang_id)) {
            return back()->withErrors(['jumlah' => 'Jumlah barang tidak sesuai pilihan.']);
        }
        $pembelian = Pembelian::create([
            'user_id' => Auth::id(),
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);
        $affectedBarangIds = [];
        foreach ($request->barang_id as $i => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = $jumlahArr[$i];
            $harga = 0; // Set harga sesuai kebutuhan
            $pembelian->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $qty,
                'harga' => $harga,
            ]);
            $barang->increment('stok', $qty);
            $affectedBarangIds[] = $barangId;
        }

        Barang::whereIn('id', array_unique($affectedBarangIds))
            ->get()
            ->each
            ->recalculateRop();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil ditambahkan');
    }
    public function show($id)
    {
        $pembelian = Pembelian::with(['user', 'details.barang'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }
    public function edit($id)
    {

        $pembelian = Pembelian::with(['details.barang'])->findOrFail($id);
        $barangs = Barang::all();
        return view('pembelian.edit', compact('pembelian', 'barangs'));
    }
    public function update(Request $request, $id)
    {

        $request->validate([
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file' => 'nullable|file|max:5120|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|string',
        ]);

        $pembelian = Pembelian::with(['details'])->findOrFail($id);
        $affectedBarangIds = $pembelian->details->pluck('barang_id')->all();

        $filePath = $pembelian->file_path;
        if ($request->hasFile('file')) {
            if ($pembelian->file_path && \Storage::disk('public')->exists($pembelian->file_path)) {
                \Storage::disk('public')->delete($pembelian->file_path);
            }
            $filePath = $request->file('file')->store('pembelian', 'public');
        }

        $jumlahArr = array_map('intval', explode(',', $request->jumlah));

        if (count($jumlahArr) !== count($request->barang_id)) {
            return back()->withErrors(['jumlah' => 'Jumlah barang tidak sesuai pilihan.']);
        }

        // Revert stok dari detail lama
        foreach ($pembelian->details as $detail) {
            $detail->barang->decrement('stok', $detail->jumlah);
        }

        // Hapus detail lama dan buat yang baru
        $pembelian->details()->delete();
        $pembelian->update([
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'keterangan' => $request->keterangan,
            'file_path' => $filePath,
        ]);

        // Tambah detail baru dan update stok
        foreach ($request->barang_id as $i => $barangId) {
            $barang = Barang::findOrFail($barangId);
            $qty = $jumlahArr[$i];
            $harga = 0;
            $pembelian->details()->create([
                'barang_id' => $barangId,
                'jumlah' => $qty,
                'harga' => $harga,
            ]);
            $barang->increment('stok', $qty);
            $affectedBarangIds[] = $barangId;
        }

        Barang::whereIn('id', array_unique($affectedBarangIds))
            ->get()
            ->each
            ->recalculateRop();

        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil diperbarui');
    }
    public function destroy($id)
    {

        $pembelian = Pembelian::with('details')->findOrFail($id);
        $affectedBarangIds = $pembelian->details->pluck('barang_id')->all();
        foreach ($pembelian->details as $detail) {
            $detail->barang->decrement('stok', $detail->jumlah);
        }
        $pembelian->delete();

        if (!empty($affectedBarangIds)) {
            Barang::whereIn('id', array_unique($affectedBarangIds))
                ->get()
                ->each
                ->recalculateRop();
        }
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus');
    }

    public function exportPdf()
    {
        $pembelians = Pembelian::with(['user', 'details.barang'])->orderByDesc('tanggal')->get();
        $generatedAt = now()->format('d/m/Y H:i');

        $pdf = Pdf::loadView('exports.pembelian', compact('pembelians', 'generatedAt'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('pembelian-' . now()->format('Ymd_His') . '.pdf');
    }
}
