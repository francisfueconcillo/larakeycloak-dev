<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LaraKeycloakController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('keycloak')
            ->scopes(['profile', 'roles'])
            ->redirect();            
    }

    public function callback()
    {
        $socialiteUser = Socialite::driver('keycloak')->user();

        session([
            'token' => $socialiteUser->token,
            'refresh_token' => $socialiteUser->refreshToken
        ]); 
        
        $user = User::where(['email' => $socialiteUser->getEmail()])->first();

        if($user) {
            Auth::login($user);
            return redirect()->intended('home');
        } else{
            $user = User::create([
                'name'          => $socialiteUser->getName(),
                'email'         => $socialiteUser->getEmail(),
                'password'      => '****',  // not nullable in User Model
            ]);

            Auth::login($user);
            return redirect()->intended('home');
        }
    }
}
