<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresion extends Model
{
    /** @use HasFactory<\Database\Factories\ImpresionFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function kampanye()
    {
        return $this->belongsTo(KampanyeIklan::class, 'kampanye_iklan_id');
    }
}
