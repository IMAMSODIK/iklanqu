<?php

namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();

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
                'user' => $user_data
            ];

            return view('dashboard.index', $data);

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.index', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function lokasi()
    {
        try {
            $data = [
                'pageTitle' => 'Daftar Lokasi',
                'lokasi' => Lokasi::all()
            ];

            return view('dashboard.lokasi', $data);

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
        return view('dashboard.riwayat');
        try {
            $data = [
                'pageTitle' => 'Daftar Riwayat'
            ];

            if (in_array(Auth::user()->role, ['admin', 'verifikator'])) {
                return view('dashboard.index_admin', $data);
            } else {
                return view('dashboard.riwayat', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }

    public function pantau()
    {
        return view('dashboard.pantau');
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

    public function akun()
    {
        return view('dashboard.akun');
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
