<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBerita extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'id_detail';

    // Kunci primer tabel
    // protected $primaryKey = 'id_detail';

    // Apakah ID tabel ini auto-increment?
    public $incrementing = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'views',
        'likes',
        'id_user',
        'id_berita',
        'id_kategori',
    ];

    // Menetapkan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    // Menetapkan relasi dengan model Berita
    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }

    // Menetapkan relasi dengan model KategoriBerita
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori', 'id_kategori');
    }
}
