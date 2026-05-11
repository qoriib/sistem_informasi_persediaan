<?php

namespace App\Http\Controllers;


use App\Models\KategoriBarang;
use Illuminate\Http\Request;

class KategoriBarangController extends Controller
{
    public function index()
    {
        $kategoriBarangs = KategoriBarang::all();
        return view('kategori_barang.index', compact('kategoriBarangs'));
    }
    public function create()
    {
        return view('kategori_barang.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        KategoriBarang::create($request->only('nama'));
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil ditambahkan');
    }
    public function edit($id)
    {
        $kategoriBarang = KategoriBarang::findOrFail($id);
        return view('kategori_barang.edit', compact('kategoriBarang'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);
        $kategoriBarang = KategoriBarang::findOrFail($id);
        $kategoriBarang->update($request->only('nama'));
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil diupdate');
    }
    public function destroy($id)
    {
        $kategoriBarang = KategoriBarang::findOrFail($id);
        $kategoriBarang->delete();
        return redirect()->route('kategori-barang.index')->with('success', 'Kategori berhasil dihapus');
    }
}
