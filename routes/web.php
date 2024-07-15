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
// Route::get('/tes', function () {
//     return view('admin/berita', compact('berita'));
// });

// Route::get('/', function () {
//     $berita = Http::get(route('api.berita'))->json();
//     $beritaPopuler = Http::get(route('api.berita.populer'))->json();
//     $kategori = Http::get(route('api.kategori'))->json();
//     return view('home', compact('berita', 'beritaPopuler', 'kategori'));
// });

// Route::get('/{kategori}', function ($kategori) {
//     $berita = Http::get(route('api.berita.kategori', ['kategori' => $kategori]))->json();
//     return view('kategori', compact('berita', 'kategori'));
// });

// Route: :get('/search/{key}', function ($key) {
//     $berita = Http::get(route('api.berita.search', ['key' => $key]))->json();
//     return view('search', compact('berita', 'key'));
// });

    Route::get('/berita/{id}', function ($id) {
         $status = request()->query('status');
         $berita = [];
        // $berita = Http::get(route('api.berita.show', ['id' => $id]))->json();
        if($status == "draft"){
            $berita = [
                'id_berita' => 1,
                'judul_berita' => "hahahha",
                'tanggal_berita' => '8824924934',
                'paragrafs' => [
                    [
                        'id_paragraf' => '1',
                        'isi_paragraf' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                        'status_paragraf' => 'upload' 
                    ],
                    [
                        'id_paragraf' => '2',
                        'isi_paragraf' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                        'status_paragraf' => 'upload' 
                    ],
                    [
                        'id_paragraf' => '3',
                        'isi_paragraf' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                        'status_paragraf' => 'edit' 
                    ]
                ]
            ];    
        }else{
            $berita = [
                'id_berita' => 1,
                'judul_berita' => "hahahha",
                'tanggal_berita' => '8824924934',
                'paragrafs' => [
                    [
                        'id_paragraf' => '1',
                        'isi_paragraf' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    ],
                    [
                        'id_paragraf' => '2',
                        'isi_paragraf' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    ],
                ]
            ];    
        }
        

        $berita = json_encode($berita);

        $berita = json_decode($berita);
        return view('preview', compact('berita'));
    })->name('berita/show');


Route::get('admin/dashboard', function () {
    $data_by_admin = [];

    return view('admin.home', compact('data_by_admin'));
})->name('admin/dashboard');

Route::get('admin/berita/draft', function () {
    // $berita = Http::get(route('api.berita.admin', ['id_admin' => $id_admin]))->json();
    $beritaJs = [
        [
            "id_berita" => 1,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "keterangan" => "awiok"
        ],
        [
            "id_berita" => 2,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "keterangan" => "awiok"
        ],
        [
            "id_berita" => 3,
            "judul_berita" => "awjhdsfjhsdjfhsdjhfjdsfhjsdhfjhikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "keterangan" => "awiok"
        ]
    ];
    
    $berita = json_encode($beritaJs);

    $berita = json_decode($berita);

    // return view('admin.normal-admin.berita.draft', compact('berita'));
    return view('admin.super-admin.berita.draft', compact('berita'));
})->name('admin/berita/draft');

//Route Normal Admin

Route::get('admin/berita/publish', function () {
    // $berita = Http::get(route('api.berita.admin', ['id_admin' => $id_admin]))->json();
    $beritaJs = [
        [
            "id_berita" => 1,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ],
        [
            "id_berita" => 2,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ],
        [
            "id_berita" => 3,
            "judul_berita" => "awjhdsfjhsdjfhsdjhfjdsfhjsdhfjhikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ]
    ];
    
    $berita = json_encode($beritaJs);

    $berita = json_decode($berita);

    return view('admin.normal-admin.berita.publish', compact('berita'));
})->name('admin/berita/publish');

Route::get('admin/berita/edit/{id}', function () {
    $kategoris = [
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

    $kategoris = json_encode($kategoris);
    
    $kategoris = json_decode($kategoris);
    // $berita = Http::get(route('api.berita.admin', ['id_admin' => $id_admin]))->json();
    
    $berita = [
        "id_berita" => "ksaklaks",
        "judul_berita" => "awikwok",
        "tanggal_berita" => "wjkaw",
        "paragrafs" => [

            [
                "id_paragraf" => "12122",
                "isi_paragraf" => "loremsdfjksdkfjksdfjkdjsfkjsdkfjkjdfsk"
            ],
            [
                "id_paragraf" => "12122",
                "isi_paragraf" => "loremsdfjksdkfjksdfjkdjsfkjsdkfjkjdfsk"
            ],
            [
                "id_paragraf" => "12122",
                "isi_paragraf" => "loremsdfjksdkfjksdfjkdjsfkjsdkfjkjdfsk"
            ],
            [
                "id_paragraf" => "12122",
                "isi_paragraf" => "loremsdfjksdkfjksdfjkdjsfkjsdkfjkjdfsk"
            ],
            [
                "id_paragraf" => "12122",
                "isi_paragraf" => "loremsdfjksdkfjksdfjkdjsfkjsdkfjkjdfsk"
            ],
        ],
        "kategori" => [
            "id_kategori" => "54548545",
            "nama_kategori" => "jfdfkdjfkjdkjf"
        ]
    ];

    $berita = json_encode($berita);

    $berita = json_decode($berita);

    return view('admin.normal-admin.berita.edit', compact('berita', 'kategoris'));
})->name('admin/berita/edit');

Route::get('admin/berita/upload', function () {
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

    $kategoris = json_encode($kategoriJs);
    
    $kategoris = json_decode($kategoris);

     return view('admin.normal-admin.berita.upload', compact('kategoris'));
})->name('admin/berita/upload');


// Route Super Admin

Route::get('admin/berita/{kategori}', function () {
    // $berita = Http::get(route('api.berita.admin', ['id_admin' => $id_admin]))->json();
   $beritaJs = [
        [
            "id_berita" => 1,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ],
        [
            "id_berita" => 2,
            "judul_berita" => "awikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ],
        [
            "id_berita" => 3,
            "judul_berita" => "awjhdsfjhsdjfhsdjhfjdsfhjsdhfjhikwok",
            "kategori" => "123",
            "tanggal_berita" => "1729",
            "views" => "72"
        ]
    ];
    
    $berita = json_encode($beritaJs);

    $berita = json_decode($berita);

    return view('admin.super-admin.berita.publish', compact('berita'));
})->name('admin/berita/{kategori}');

Route::get('admin/manage', function () {
    // $data = Http::get(route('api.dashboard.data'))->json();
    return view('admin.super-admin.akun.index');
})->name('admin/manage');

Route::get('admin/kategori', function () {
    $kategori = Http::get(route('api.kategori'));

    return view('admin.super-admin.kategori.index', compact('kategori'));
})->name('admin/kategori');

Route::post('admin/kategori/manage', function (Request $request) {
    return response()->json(['message' => "awweh"]);
})->name('admin/kategori/manage');


