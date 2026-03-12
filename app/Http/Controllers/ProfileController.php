<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "Profile",
                'data' => Profile::first()
            ];

            return view('profile.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'email'     => 'required|email|max:255',
                'no_hp'     => 'required|string|max:20',
                'instagram' => 'nullable|string|max:255',
                'tiktok'    => 'nullable|string|max:255',
                'alamat'    => 'required|string'
            ]);

            Profile::updateOrCreate(
                ['id' => 1],
                [
                    'email'     => $request->email,
                    'no_hp'     => $request->no_hp,
                    'instagram' => $request->instagram,
                    'tiktok'    => $request->tiktok,
                    'alamat'    => $request->alamat
                ]
            );

            return response()->json([
                'status' => true,
                'message' => 'Profile berhasil diperbarui'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan saat menyimpan profile'
            ],500);
        }
    }
}
