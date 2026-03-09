<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user()->role;
            dd($user);
            $data = [
                'pageTitle' => 'Dashboard'
            ];

            return view('dashboard.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }
}
