<?php

namespace App\Http\Controllers;

use App\Models\KampanyeIklan;
use Illuminate\Http\Request;

class VerifikasiIklanController extends Controller
{
    public function index()
    {
        try {
            $pendingCampaigns = KampanyeIklan::with('user')
                ->where('payment_status', 'paid')
                ->where('is_active', false)
                ->latest()
                ->get();

            $historyCampaigns = KampanyeIklan::with('user')
                ->where('is_active', true)
                ->latest()
                ->get();

            $data = [
                'pageTitle'        => 'Verifikasi Iklan',
                'pendingCampaigns' => $pendingCampaigns,
                'historyCampaigns' => $historyCampaigns,
                'pendingCount'     => $pendingCampaigns->count(),
            ];

            return view('verifikasi.index', $data);
        } catch (\Exception $e) {

            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function verifikasi($id)
    {
        try {

            $campaign = KampanyeIklan::findOrFail($id);

            $campaign->update([
                'is_active' => true
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Iklan berhasil diverifikasi'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }
}
