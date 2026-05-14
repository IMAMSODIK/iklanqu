<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LokasiKampanyeIklan extends Model
{
    /** @use HasFactory<\Database\Factories\LokasiKampanyeIklanFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class);
    }
}
