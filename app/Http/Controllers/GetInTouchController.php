<?php

namespace App\Http\Controllers;

use App\Models\GetInTouch;
use App\Http\Requests\StoreGetInTouchRequest;
use App\Http\Requests\UpdateGetInTouchRequest;
use Illuminate\Http\Request;

class GetInTouchController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "Get in Touch",
                'data'      => GetInTouch::all()
            ];

            return view('touch.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nama' => 'required|string|max:255',
                'no_wa' => 'required|string|max:20',
                'pesan' => 'required|string'
            ]);

            GetInTouch::create([
                'nama' => $request->nama,
                'no_wa' => $request->no_wa,
                'pesan' => $request->pesan
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Pesan berhasil dikirim'
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan'
            ]);
        }
    }

    public function delete(Request $r)
    {
        try {

            $r->validate([
                'id' => 'required|exists:get_in_touches,id'
            ]);

            $touch = GetInTouch::findOrFail($r->id);

            $touch->delete();

            return response()->json([
                'status' => true,
                'message' => 'Pesan berhasil dinonaktifkan'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal menonaktifkan pesan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
