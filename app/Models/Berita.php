<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'berita';

    // Kunci primer tabel
    protected $primaryKey = 'id_berita';

    // Apakah ID tabel ini auto-increment?
    public $incrementing = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'judul_berita',
        'gambar',
        'isi_berita',
        'tanggal_berita',
        'status_berita',
    ];

    // Kolom yang dianggap sebagai tanggal
    protected $dates = ['tanggal_berita'];

    // Menetapkan relasi dengan model Detail
    public function detail()
    {
        return $this->hasOne(Detail::class, 'id_berita', 'id_berita');
    }

    // Menetapkan relasi dengan model KomentarBerita
    public function komentarBeritas()
    {
        return $this->hasMany(KomentarBerita::class, 'id_berita', 'id_berita');
    }
}