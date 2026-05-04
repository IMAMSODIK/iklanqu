<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KampanyeIklan extends Model
{
    /** @use HasFactory<\Database\Factories\KampanyeIklanFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function lokasi()
    {
        return $this->belongsToMany(Lokasi::class)
            ->withPivot('tanggal_mulai', 'tanggal_selesai')
            ->withTimestamps();
    }
}
