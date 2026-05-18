<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ✅ TAMBAHKAN
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable; // ✅ TAMBAHKAN HasFactory

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto',
        'phone',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}