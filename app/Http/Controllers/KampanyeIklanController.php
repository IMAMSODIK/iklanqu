<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use App\Http\Requests\StoreKampanyeIklanRequest;
use App\Http\Requests\UpdateKampanyeIklanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KampanyeIklanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'media' => 'required|file',
        ]);

        $path = null;
        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('campaigns', 'public');
        }

        $campaign = KampanyeIklan::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'description' => $request->description,
            'media' => $path,
        ]);

        $locations = json_decode($request->locations, true);

        foreach ($locations as $loc) {
            $campaign->lokasi()->attach($loc['location_id'], [
                'tanggal_mulai' => $loc['tanggal_mulai'],
                'tanggal_selesai' => $loc['tanggal_selesai'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Campaign berhasil disimpan'
        ]);
    }
}
