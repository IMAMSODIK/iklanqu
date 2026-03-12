<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        try {
            $data = [
                'pageTitle' => 'Login'
            ];

            return view('auth.login', $data);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat membuka halaman login.');
        }
    }

    public function redirectGoogle()
    {
        try {

            return Socialite::driver('google')->redirect();
        } catch (\Exception $e) {

            return redirect('/login')->with('error', 'Gagal menghubungkan ke Google');
        }
    }

    public function handleGoogleCallback()
    {
        try {

            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {

                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'foto' => $googleUser->avatar,
                    'role' => 'user',
                    'password' => bcrypt(rand(100000, 999999))
                ]);
            } else {
                $user->update([
                    'google_id' => $googleUser->id,
                    'foto' => $googleUser->avatar
                ]);
            }

            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {

            return redirect('/login')->with('error', 'Login Google gagal');
        }
    }
}
