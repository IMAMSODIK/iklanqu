<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatIklan extends Controller
{
    public function detailRiwayat($id)
    {
        try {

            $iklan = KampanyeIklan::with([
                'lokasiKampanyeIklans.lokasi',
                'payments'
            ])
                ->where('user_id', Auth::id())
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $iklan
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
