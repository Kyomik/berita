<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\User;
use App\Models\KomentarBerita;
use App\Models\DetailBerita;

class BeritaController extends Controller
{
    public function uploadBerita(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_berita' => 'required|string|max:255',
            'gambar' => 'required|string',
            'isi_berita' => 'required|string',
            'id_kategori' => 'required|integer',
            'id_user' => 'required|integer',
        ]);

        // Simpan berita
        $berita = Berita::create([
            'judul_berita' => $request->judul_berita,
            'gambar' => $request->gambar,
            'isi_berita' => $request->isi_berita,
            'tanggal_berita' => now(),
            'status_berita' => 'draft',
        ]);

        return response()->json(['message' => 'Success, tunggu sampai diacc']);
    }

    public function getAllBerita()
    {
        $berita = Berita::where('status_berita', 'published')->get(['id_berita', 'judul_berita', 'gambar', 'isi_berita', 'tanggal_berita']);
        return response()->json($berita);
    }

    public function getBeritaPopuler()
    {
        $berita = Berita::where('status_berita', 'published')
            ->orderBy('tanggal_berita', 'desc')
            ->limit(5)
            ->get(['id_berita', 'judul_berita', 'gambar', 'isi_berita', 'tanggal_berita']);
        return response()->json($berita);
    }

    public function getBeritaByAdmin($id_admin)
    {
        $berita = Berita::where('id_user', $id_admin)->get(['id_berita', 'judul_berita', 'gambar', 'isi_berita', 'tanggal_berita', 'status_berita']);
        return response()->json($berita);
    }

    public function getBeritaByKategori($kategori)
    {
        $berita = Berita::whereHas('kategori', function($query) use ($kategori) {
            $query->where('nama_kategori', $kategori);
        })->get(['id_berita', 'judul_berita', 'gambar', 'isi_berita']);
        return response()->json($berita);
    }

    public function getBeritaByJudul($text)
    {
        $berita = Berita::where('judul_berita', 'LIKE', "%{$text}%")->get(['id_berita', 'judul_berita', 'gambar', 'isi_berita', 'tanggal_berita']);
        return response()->json($berita);
    }

    public function getBeritaById($id_berita)
    {
        $berita = Berita::with(['user', 'komentar'])->findOrFail($id_berita);
        return response()->json($berita);
    }

    public function updateBerita(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_berita' => 'required|integer',
            'id_user' => 'required|integer',
            'new_judul_berita' => 'required|string|max:255',
            'new_gambar_berita' => 'required|string',
            'new_isi_berita' => 'required|string',
            'id_kategori' => 'required|integer',
            'new_kategori' => 'required|integer',
        ]);

        // Update berita
        $berita = Berita::where('id_berita', $request->id_berita)->first();
        $berita->update([
            'judul_berita' => $request->new_judul_berita,
            'gambar' => $request->new_gambar_berita,
            'isi_berita' => $request->new_isi_berita,
            'id_kategori' => $request->new_kategori,
            'status_berita' => 'draft',
        ]);

        return response()->json(['message' => 'Success, tunggu sampai diacc']);
    }

    public function deleteBerita(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_berita' => 'required|integer',
            'id_user' => 'required|integer',
        ]);

        // Hapus berita
        Berita::where('id_berita', $request->id_berita)->delete();

        return response()->json(['message' => 'Success, tunggu sampai diacc']);
    }

    public function accBerita($id_berita, $id_user)
    {
        $berita = Berita::where('id_berita', $id_berita)->update(['status_berita' => 'published']);
        return response()->json(['message' => 'Berita telah diacc']);
    }
}
