<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'kategori_berita';

    // Kunci primer tabel
    protected $primaryKey = 'id_kategori';

    // Apakah ID tabel ini auto-increment?
    public $incrementing = true;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'nama_kategori',
    ];

    // Menetapkan relasi dengan model Detail
    public function details()
    {
        return $this->hasMany(Detail::class, 'id_kategori', 'id_kategori');
    }
}
