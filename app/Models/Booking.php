<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'kontrakan_id',
        'no_hp',
          'tanggal_mulai',
        'tanggal_selesai',
        'lama_sewa',
        'metode_pembayaran',
        'bukti_pembayaran',
        'total_harga',
        'status',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELASI
    |--------------------------------------------------------------------------
    */

    // USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // KONTRAKAN
    public function kontrakan()
    {
        return $this->belongsTo(Kontrakan::class);
    }

    // PEMBAYARAN
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}