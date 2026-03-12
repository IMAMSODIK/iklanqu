<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use App\Http\Requests\StoreLokasiRequest;
use App\Http\Requests\UpdateLokasiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "Lokasi",
                'data'      => Lokasi::with('board')
                    ->orderBy('id', 'desc')
                    ->get()
            ];

            return view('lokasi.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'link_maps' => 'nullable|string|max:500',
                'gambar' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $path = null;

            if ($request->hasFile('gambar')) {
                $path = $request->file('gambar')->store('lokasi', 'public');
            }

            $lokasi = Lokasi::create([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'link_maps' => $request->link_maps,
                'gambar' => $path
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Lokasi berhasil ditambahkan',
                'data' => $lokasi
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function detail(Request $r)
    {
        try {

            $validator = Validator::make($r->all(), [
                'id' => 'required|exists:lokasis,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors()
                ], 422);
            }

            $lokasi = Lokasi::with('board')->find($r->id);

            if (!$lokasi) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Lokasi not found'
                ], 404);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Lokasi data retrieved successfully.',
                'data'    => $lokasi
            ], 200);
        } catch (\Exception $e) {

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|exists:lokasis,id',
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string',
                'link_maps' => 'nullable|string|max:500',
                'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $lokasi = Lokasi::findOrFail($request->id);

            if ($request->hasFile('gambar')) {

                if ($lokasi->gambar && Storage::disk('public')->exists($lokasi->gambar)) {

                    Storage::disk('public')->delete($lokasi->gambar);
                }

                $path = $request->file('gambar')
                    ->store('lokasi', 'public');

                $lokasi->gambar = $path;
            }

            $lokasi->nama = $request->nama;
            $lokasi->alamat = $request->alamat;
            $lokasi->link_maps = $request->link_maps;
            $lokasi->save();

            return response()->json([
                'status' => true,
                'message' => 'Lokasi berhasil diupdate',
                'data' => $lokasi
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Update lokasi gagal',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $r)
    {
        try {

            $r->validate([
                'id' => 'required|exists:lokasis,id'
            ]);

            $lokasi = Lokasi::findOrFail($r->id);

            $lokasi->status = 0;
            $lokasi->save();

            return response()->json([
                'status' => true,
                'message' => 'Lokasi berhasil dinonaktifkan'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal menonaktifkan lokasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function activate(Request $request)
    {
        try {

            $request->validate([
                'id' => 'required|exists:lokasis,id'
            ]);

            $lokasi = Lokasi::findOrFail($request->id);

            $lokasi->status = 1;
            $lokasi->save();

            return response()->json([
                'status' => true,
                'message' => 'Lokasi berhasil diaktifkan'
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Gagal mengaktifkan lokasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {

            $q = $request->q;

            $data = Lokasi::where('nama', 'like', "%$q%")
                ->orWhere('alamat', 'like', "%$q%")
                ->orderBy('id', 'desc')
                ->get();

            if ($data->isEmpty()) {

                return response()->json([
                    'status' => false,
                    'message' => 'Lokasi tidak ditemukan'
                ]);
            }

            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } catch (\Throwable $e) {

            return response()->json([
                'status' => false,
                'message' => 'Search gagal',
                'error' => $e->getMessage()
            ]);
        }
    }
}
