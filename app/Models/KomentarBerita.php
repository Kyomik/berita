<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomentarBerita extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'komentar_berita';

    // Kunci primer tabel
    protected $primaryKey = 'id_komentar';

    // Apakah ID tabel ini auto-increment?
    public $incrementing = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'id_berita',
        'id_user',
        'isi_komentar',
        'tanggal_komentar',
    ];

    // Kolom yang dianggap sebagai tanggal
    protected $dates = ['tanggal_komentar'];

    // Menetapkan relasi dengan model Berita
    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }

    // Menetapkan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
