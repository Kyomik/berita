<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model
    protected $table = 'login';

    // Kunci primer tabel
    protected $primaryKey = 'username';

    // Apakah ID tabel ini auto-increment?
    public $incrementing = false;

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'username',
        'password',
        'id_user',
    ];

    // Menetapkan relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
