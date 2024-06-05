<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            Auth::login($existingUser, true);
        } else {
            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('password') // Anda bisa mengganti ini dengan cara lain
            ]);

            Auth::login($newUser, true);
        }

        return redirect()->intended('/home');
    }
}
