<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewReport extends Model
{
    public $timestamps = true;

    protected $fillable = [
        'review_id',
        'user_id',
        'alasan',
    ];

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
