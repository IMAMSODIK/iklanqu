<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "User",
                'users'     => User::where('role', 'user')->where('status', 1)->orderBy('id', 'desc')->get(),
                'data'      => User::whereIn('role', ['admin', 'verifikator'])
                    ->where('status', 1)
                    ->orderBy('id', 'desc')
                    ->get()
            ];

            return view('user.index', $data);
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
                'message' => 'User berhasil dinonaktifkan'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal menonaktifkan user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $r)
    {
        try {

            $r->validate([
                'id' => 'required|exists:users,id',
                'role' => 'required'
            ]);

            $user = User::findOrFail($r->id);

            $user->role = $r->role;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'User sekarang menjadi ' . ($r->role == 'verifikator' ? 'Verifikator' : 'User')
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'no_kamar' => 'required|unique:kamars,no_kamar'
    //         ]);

    //         Kamar::create([
    //             'no_kamar' => $request->no_kamar
    //         ]);

    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Kamar berhasil ditambahkan'
    //         ]);
    //     } catch (\Exception $e) {

    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Terjadi kesalahan: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    // public function edit(Request $request)
    // {
    //     $id = $request->id;

    //     try {
    //         $kamar = Kamar::findOrFail($id);
    //         return response()->json($kamar);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Data tidak ditemukan'
    //         ], 404);
    //     }
    // }

    // public function delete(Request $request)
    // {
    //     $id = $request->id;

    //     try {
    //         $kamar = Kamar::findOrFail($id);
    //         $kamar->delete();
            
    //         return response()->json([
    //             'status' => true
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Data tidak ditemukan'
    //         ], 404);
    //     }
    // }
}
