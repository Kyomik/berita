<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/tes', function () {
    return view('layouts/admin');
});

Route::get('/', function () {
    $berita = Http::get(route('api.berita'))->json();
    $beritaPopuler = Http::get(route('api.berita.populer'))->json();
    $kategori = Http::get(route('api.kategori'))->json();
    return view('home', compact('berita', 'beritaPopuler', 'kategori'));
});

Route::get('/{kategori}', function ($kategori) {
    $berita = Http::get(route('api.berita.kategori', ['kategori' => $kategori]))->json();
    return view('kategori', compact('berita', 'kategori'));
});

Route::get('/search/{key}', function ($key) {
    $berita = Http::get(route('api.berita.search', ['key' => $key]))->json();
    return view('search', compact('berita', 'key'));
});

Route::get('/berita/{id}', function ($id) {
    $berita = Http::get(route('api.berita.show', ['id' => $id]))->json();
    return view('berita', compact('berita'));
});

Route::get('admin/dashboard', function () {
    $data = Http::get(route('api.dashboard.data'))->json();
    return view('admin.dashboard', compact('data'));
});

Route::get('admin/kategori', function () {
    $kategori = Http::get(route('api.kategori'))->json();
    return view('admin.kategori', compact('kategori'));
});

Route::get('admin/berita/{id_admin}', function ($id_admin) {
    $berita = Http::get(route('api.berita.admin', ['id_admin' => $id_admin]))->json();
    return view('admin.berita', compact('berita'));
});

Route::get('admin/berita/upload', function () {
    $kategori = Http::get(route('api.kategori'))->json();
    return view('admin.upload_berita', compact('kategori'));
});

Route::post('admin/berita/upload', function (Request $request) {
    $response = Http::post(route('api.upload_berita'), [
        'judul_berita' => $request->judul_berita,
        'gambar' => $request->gambar,
        'isi_berita' => $request->isi_berita,
        'id_kategori' => $request->id_kategori,
        'id_user' => auth()->id(),
    ]);
    return redirect('admin/berita')->with('status', $response->json()['message']);
});
