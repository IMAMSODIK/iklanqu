<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => 'Dashboard'
            ];

            return view('dashboard.index', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }
}
