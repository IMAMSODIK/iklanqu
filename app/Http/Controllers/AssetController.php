<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function download($asset_id)
    {
        $asset = KampanyeIklan::where(
            'asset_id',
            $asset_id
        )->firstOrFail();

        $path = storage_path(
            'app/public/' . $asset->media
        );

        return response()->download($path);
    }
}
