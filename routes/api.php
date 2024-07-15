<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AuthController;

// Endpoint API untuk Berita
Route::post('/berita/upload', function(Request $request){
    return response()->json(['redirect' => route('admin/berita/publish')], 200);
})->name('api.berita.upload');

Route::post('/berita/delete', [BeritaController::class, 'deleteBerita'])->name('api.berita.delete');

Route::post('/berita/edit', function(Request $request){
	return response()->json(['redirect' => route('admin/berita/publish')], 200);
})->name('api.berita.edit');

Route::get('/berita', [BeritaController::class, 'getAllBerita'])->name('api.berita');
Route::get('/berita/populer', [BeritaController::class, 'getBeritaPopuler'])->name('api.berita.populer');
Route::get('/berita/admin/{id_admin}', [BeritaController::class, 'getBeritaByAdmin'])->name('api.berita.admin');
Route::get('/berita/kategori/{kategori}', [BeritaController::class, 'getBeritaByKategori'])->name('api.berita.kategori');
Route::get('/berita/search/{text}', [BeritaController::class, 'getBeritaByJudul'])->name('api.berita.search');
Route::get('/berita/{id_berita}', [BeritaController::class, 'getBeritaById'])->name('api.berita.show');

Route::get('/berita/acc/{id_berita}/{id_user}', [BeritaController::class, 'accBerita'])->name('api.berita.acc');

// Endpoint API untuk Kategori
Route::post('/kategori/create', [KategoriController::class, 'createKategori'])->name('api.kategori.create');
Route::get('/kategori', function(Request $request){
	 $kategoriJs = [
        [
            "id_kategori" => 12,
            "nama_kategori" => "olahraga"
        ],
        [
            "id_kategori" => 13,
            "nama_kategori" => "pembunuhan"
        ],
        [
            "id_kategori" => 14,
            "nama_kategori" => "sekolah"
        ],
        [
            "id_kategori" => 15,
            "nama_kategori" => "sekolah"
        ]
    ];

	return response()->json($kategoriJs);
})->name('api.kategori');
Route::post('/kategori/update', [KategoriController::class, 'updateKategori'])->name('api.kategori.update');
Route::post('/kategori/delete', [KategoriController::class, 'deleteKategori'])->name('api.kategori.delete');

// Endpoint API untuk Autentikasi dan Manajemen Pengguna
Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [AuthController::class, 'register'])->name('api.register');
Route::post('/admin/add', [AuthController::class, 'addAdmin'])->name('api.admin.add');

Route::get('/komentar/{berita_id}', function($berita_id) {
	$komentar = [
		[
	        'isi_komentar' => $berita_id,
	        'tanggal_komentar' => '89849839489348',
	        'user' => 'joni'
		],
		[
	        'isi_komentar' => 'awikwokowkowkow',
	        'tanggal_komentar' => '89849839489348',
	        'user' => 'joni'
		],
		[
	        'isi_komentar' => 'awikwokowkowkow',
	        'tanggal_komentar' => '89849839489348',
	        'user' => 'joni'
		],
		[
	        'isi_komentar' => 'awikwokowkowkow',
	        'tanggal_komentar' => '89849839489348',
	        'user' => 'joni'
		]
	];
    // $komentars = Komentar::where('berita_id', $berita_id)->get();
    return response()->json($komentar);
})->name('api.komentar');
