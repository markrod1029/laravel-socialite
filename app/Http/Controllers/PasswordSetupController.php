<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PasswordSetupController extends Controller
{
    public function showSetupForm()
    {
        return view('auth.setup');
    }

    public function setupPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $google_id = Session::get('google_id');
        $user = User::where('google_id', $google_id)->first();

        if ($user) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::login($user);

            return redirect()->intended('dashboard');
        }

        return redirect()->route('login')->withErrors(['error' => 'User not found.']);
    }
}
