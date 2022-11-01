<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SSOController extends Controller
{
    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleHandler()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(Str::random(8))
            ]);
      
            Auth::login($user);
            return redirect()->intended('dashboard');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
