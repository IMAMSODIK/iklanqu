<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class KampanyeIklan extends Model
{
    /** @use HasFactory<\Database\Factories\KampanyeIklanFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    protected static function booted()
    {
        static::creating(function ($item) {

            if (!$item->asset_id) {
                $item->asset_id = Str::uuid();
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'kampanye_iklan_id');
    }

    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class, 'lokasi_kampanye_iklans')
            ->withPivot('tanggal_mulai', 'tanggal_selesai')
            ->withTimestamps();
    }

    public function lokasiKampanyeIklans()
    {
        return $this->hasMany(LokasiKampanyeIklan::class, 'kampanye_iklan_id');
    }

    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_kampanye_iklan');
    }

    public function impresions()
    {
        return $this->hasMany(Impresion::class, 'kampanye_iklan_id');
    }
}
