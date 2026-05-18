<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
    'booking_id',
    'metode',
    'bukti',
    'status',
    'jumlah',
];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}