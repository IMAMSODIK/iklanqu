<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\BoardPhoto;
use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BoardController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => "Boards",
                'lokasi'    => Lokasi::all(),
                'data'      => Board::with(['photos', 'lokasi'])
                    ->orderBy('id', 'desc')
                    ->get()
            ];

            return view('board.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data.');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:boards,name',
            'kode' => 'required|unique:boards,kode',
            'pin' => 'required',
            'lokasi_id' => 'required',
            'photos' => 'nullable|array',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::beginTransaction();

        try {

            $board = Board::create([
                'name' => $request->name,
                'kode' => $request->kode,
                'pin' => $request->pin,
                'lokasi_id' => $request->lokasi_id
            ]);

            if ($request->hasFile('photos')) {

                foreach ($request->file('photos') as $photo) {

                    $path = $photo->store('boards', 'public');

                    BoardPhoto::create([
                        'board_id' => $board->id,
                        'file' => $path
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "status" => true,
                "message" => "Board berhasil ditambahkan",
                "data" => $board->load('photos', 'lokasi')
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function detail(Request $r)
    {
        try {

            $validator = Validator::make($r->all(), [
                'id' => 'required|exists:boards,id'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation error',
                    'errors'  => $validator->errors()
                ], 422);
            }

            $board = Board::with(['photos', 'lokasi'])->find($r->id);

            if (!$board) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Board not found'
                ], 404);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Board data retrieved successfully.',
                'data'    => $board
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
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'kode' => 'required',
            'pin' => 'required',
            'lokasi_id' => 'required',
            'photos.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        DB::beginTransaction();

        try {

            $board = Board::findOrFail($request->id);

            $board->update([
                'name' => $request->name,
                'kode' => $request->kode,
                'pin' => $request->pin,
                'lokasi_id' => $request->lokasi_id
            ]);

            if ($request->hasFile('photos')) {

                foreach ($request->file('photos') as $photo) {

                    $path = $photo->store('boards', 'public');

                    BoardPhoto::create([
                        'board_id' => $board->id,
                        'file' => $path
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Board berhasil diupdate',
                'board' => $board->load('photos', 'lokasi')
            ]);
        } catch (\Exception $e) {

            DB::rollback();

            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deletePhoto(Request $request)
    {
        $photo = BoardPhoto::findOrFail($request->id);

        if ($photo->file && Storage::disk('public')->exists($photo->file)) {
            Storage::disk('public')->delete($photo->file);
        }

        $photo->delete();

        return response()->json([
            'status' => true,
            'message' => 'Foto berhasil dihapus'
        ]);
    }

    public function delete(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id'    => 'required|exists:boards,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $board = Board::findOrFail($r->id);

            $board->status = 0;
            $board->save();

            return response()->json([
                'status'  => true,
                'message' => 'Board has been deactivated.',
                'data'    => $board
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to update board information.',
                'errors'  => ['exception' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function activate(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'id'    => 'required|exists:boards,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation errors occurred.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $board = Board::findOrFail($r->id);
            $board->status = 1;
            $board->save();

            return response()->json([
                'status'  => true,
                'message' => 'Board has been Activated.',
                'data'    => $board
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'  => false,
                'message' => 'Failed to update board information.',
                'errors'  => ['exception' => [$e->getMessage()]]
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->get('q');

        $boards = Board::with(['photos', 'lokasi'])
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%")
                    ->orWhere('kode', 'like', "%{$keyword}%");
            })
            ->get();

        if ($boards->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No board found.'
            ], 200);
        }

        return response()->json([
            'status' => true,
            'data' => $boards
        ], 200);
    }
}
