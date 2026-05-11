<?php

namespace App\Http\Controllers;


use App\Models\Barang;
use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barangs = Barang::with('kategori')->get();
        return view('barang.index', compact('barangs'));
    }
    public function create()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('barang.create', compact('kategoriBarangs'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:50|unique:barangs,kode',
            'nama' => 'required|string|max:255',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'stok' => 'required|integer|min:0',
            'rop' => 'required|integer|min:0',
        ]);
        Barang::create($request->only('kode', 'nama', 'kategori_barang_id', 'stok', 'rop'));
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan');
    }
    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoriBarangs = KategoriBarang::all();
        return view('barang.edit', compact('barang', 'kategoriBarangs'));
    }
    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $request->validate([
            'kode' => 'required|string|max:50|unique:barangs,kode,' . $barang->id,
            'nama' => 'required|string|max:255',
            'kategori_barang_id' => 'required|exists:kategori_barangs,id',
            'stok' => 'required|integer|min:0',
            'rop' => 'required|integer|min:0',
        ]);
        $barang->update($request->only('kode', 'nama', 'kategori_barang_id', 'stok', 'rop'));
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diupdate');
    }
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus');
    }
}
