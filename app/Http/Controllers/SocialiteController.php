<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('keycloak')
            ->scopes(['profile', 'roles'])
            ->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('keycloak')->user();
        $user = User::where(['email' => $socialUser->getEmail()])->first();

        if($user) {
            Auth::login($user);
            return redirect()->route('home');
        } else{
            $user = User::create([
                'name'          => $socialUser->getName(),
                'email'         => $socialUser->getEmail(),
                'password'      => '****',  // not nullable in User Model
            ]);

            Auth::login($user);
            return redirect()->route('home');
        }
    }
}
