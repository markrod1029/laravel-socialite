<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user = Socialite::driver('google')->user();

            // Find the user by google_id
            $user = User::where('google_id', $google_user->getId())->first();

            if (!$user) {
                // If user not found by google_id, try to find by email
                $user = User::where('email', $google_user->getEmail())->first();

                if (!$user) {
                    // If user not found by email, create a new user
                    $user = User::create([
                        'name' => $google_user->getName(),
                        'email' => $google_user->getEmail(),
                        'google_id' => $google_user->getId(),
                    ]);
                    // Redirect to password setup
                    Session::put('google_id', $google_user->getId());
                    return redirect()->route('auth.setup'); // This route is named 'auth.setup'
                } else {
                    // If user found by email but not by google_id, update the user
                    $user->update([
                        'google_id' => $google_user->getId(),
                    ]);
                }
            }

            Auth::login($user);

            return redirect()->intended('dashboard');

        } catch (\Throwable $th) {
            dd('Something went wrong: ' . $th->getMessage());
        }
    }
}
