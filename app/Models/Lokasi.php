<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    /** @use HasFactory<\Database\Factories\LokasiFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function board()
    {
        return $this->hasMany(Board::class);
    }

    public function kampanyeIklan()
    {
        return $this->belongsToMany(KampanyeIklan::class, 'lokasi_kampanye_iklans')
            ->withPivot('tanggal_mulai', 'tanggal_selesai')
            ->withTimestamps();
    }
}
