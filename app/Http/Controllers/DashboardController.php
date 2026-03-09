<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'pageTitle' => 'Dashboard'
            ];

            if(in_array(Auth::user()->role, ['admin', 'verifikator'])){
                return view('dashboard.index_admin', $data);
            }else{
                return view('dashboard.index', $data);
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman dashboard.');
        }
    }
}
