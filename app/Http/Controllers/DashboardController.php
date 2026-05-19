<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\KampanyeIklan;
use App\Models\Lokasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            //setelah dev selesai buka komentar ini agar yang aktif adalah user yang sudah login
            $user = Auth::user();

            // $user = User::first();

            $user_data = (object)[
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'foto' => $user->foto,
                'no_wa' => $user->no_wa,
                'status' => $user->status,
                'tutorial' => $user->tutorial
            ];

            $data = [
                'pageTitle' => 'Dashboard',
                'user' => $user_data,
                'lokasis' => Lokasi::where('status', 1)->orderBy('nama')->get()
            ];


            if (in_array($user->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                $data['boards'] = Board::with('lokasi')->get();
                return view('dashboard.index', $data);
            }
            // return view('dashboard.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function lokasi()
    {
        try {
            $data = [
                'pageTitle' => 'Daftar Lokasi',
                'lokasi' => Lokasi::with('board.photos')->get()
            ];

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.lokasi', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function riwayat()
    {
        try {

            $riwayat = KampanyeIklan::with([
                'lokasiKampanyeIklans.lokasi',
                'payments'
            ])
                ->where('user_id', Auth::id())
                ->latest()
                ->get();

            $data = [
                'pageTitle' => 'Daftar Riwayat',
                'riwayat'   => $riwayat
            ];

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.riwayat', $data);
            }
        } catch (\Exception $e) {

            return back()->with(
                'error',
                'Terjadi kesalahan saat membuka halaman dashboard.'
            );
        }
    }

    public function pantau()
    {
        try {
            $data = [
                'pageTitle' => 'Daftar Pantau'
            ];

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.pantau', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function pantauRealtime()
    {
        try {
            $user = Auth::user();

            $campaigns = KampanyeIklan::query()
                ->withSum('impresions as total_play_count', 'play_count')
                ->withSum('impresions as total_people_count', 'people_count')
                ->get();

            $rows = [];

            $totalPlay = 0;
            $totalPeople = 0;
            $totalImpression = 0;

            foreach ($campaigns as $campaign) {

                $playCount = (int) ($campaign->total_play_count ?? 0);

                $peopleCount = (int) ($campaign->total_people_count ?? 0);

                $impression = $playCount + $peopleCount;

                $totalPlay += $playCount;

                $totalPeople += $peopleCount;

                $totalImpression += $impression;

                $rows[] = [

                    'id' => $campaign->id,

                    'nama' => $campaign->nama_kampanye,

                    'play_count' => $playCount,

                    'people_count' => $peopleCount,

                    'impression' => $impression,

                ];
            }

            return response()->json([

                'success' => true,

                'data' => [

                    'total_play_count' => $totalPlay,

                    'total_people_count' => $totalPeople,

                    'total_impression' => $totalImpression,

                    'campaigns' => $rows

                ]

            ]);
        } catch (\Exception $e) {

            return response()->json([

                'success' => false,

                'message' => $e->getMessage()

            ], 500);
        }
    }

    public function akun()
    {
        try {
            $data = [
                'pageTitle' => 'Daftar Akun'
            ];

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.akun', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function tutorialSelesai(Request $r)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user) {
            $user->update([
                'tutorial' => 1,
                'no_wa' => $r->no_wa
            ]);
        }

        return response()->json([
            'status' => 'success'
        ]);
    }
}
