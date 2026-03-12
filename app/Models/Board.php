<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /** @use HasFactory<\Database\Factories\BoardFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function photos()
    {
        return $this->hasMany(BoardPhoto::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }
}
