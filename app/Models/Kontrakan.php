<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontrakan extends Model
{
    use HasFactory;

    protected $table = 'kontrakans';

    protected $fillable = [
        'user_id', // 🔥 INI WAJIB
        'nama',
        'alamat',
        'wilayah',
        'harga',
        'jumlah_kamar',
        'fasilitas',
        'deskripsi',
        'fotos',

        // 🔐 approval status
        'status_pengajuan',

        // 🏠 ketersediaan
        'status',
    ];

    // otomatis decode JSON <-> array
    protected $casts = [
        'fotos' => 'array',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function kamars()
{
    return $this->hasMany(Kamar::class);
}
}