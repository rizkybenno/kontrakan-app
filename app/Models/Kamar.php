<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'kontrakan_id',
        'nama_kamar',
        'harga',
        'status',
        'deskripsi',
    ];

    public function kontrakan()
    {
        return $this->belongsTo(Kontrakan::class);
    }
}