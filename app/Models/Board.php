<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Board extends Model
{
    /** @use HasFactory<\Database\Factories\BoardFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($board) {

            if (!$board->device_token) {
                $board->device_token = Str::random(64);
            }
        });
    }

    public function photos()
    {
        return $this->hasMany(BoardPhoto::class);
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function kampanyes()
    {
        return $this->belongsToMany(KampanyeIklan::class, 'board_kampanye_iklan')
            ->withPivot(['urutan', 'start_at', 'end_at']);
    }

    public function playlistItems()
    {
        return $this->hasMany(BoardKampanyeIklan::class);
    }
}
