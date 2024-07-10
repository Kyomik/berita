<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriBerita;

class KategoriController extends Controller
{
    public function createKategori(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriBerita::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return response()->json(['message' => 'Kategori berhasil dibuat']);
    }

    public function getAllKategori()
    {
        $kategori = KategoriBerita::all(['id_kategori', 'nama_kategori']);
        return response()->json($kategori);
    }

    public function updateKategori(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|integer',
            'new_nama_kategori' => 'required|string|max:255',
        ]);

        $kategori = KategoriBerita::where('id_kategori', $request->id_kategori)->first();
        $kategori->update([
            'nama_kategori' => $request->new_nama_kategori,
        ]);

        return response()->json(['message' => 'Kategori berhasil diedit']);
    }

    public function deleteKategori(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|integer',
        ]);

        KategoriBerita::where('id_kategori', $request->id_kategori)->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus']);
    }
}
