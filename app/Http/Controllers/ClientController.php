<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "Client",
                'data'      => User::where('role', 'user')
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get()
            ];

            return view('client.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function delete(Request $r)
    {
        try {

            $r->validate([
                'id' => 'required|exists:users,id'
            ]);

            $user = User::findOrFail($r->id);

            $user->status = 0;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Client berhasil dinonaktifkan'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal menonaktifkan client',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function activate(Request $request)
    // {
    //     try {

    //         $request->validate([
    //             'id' => 'required|exists:lokasis,id'
    //         ]);

    //         $lokasi = Lokasi::findOrFail($request->id);

    //         $lokasi->status = 1;
    //         $lokasi->save();

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Lokasi berhasil diaktifkan'
    //         ]);
    //     } catch (\Throwable $e) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Gagal mengaktifkan lokasi',
    //             'error' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
