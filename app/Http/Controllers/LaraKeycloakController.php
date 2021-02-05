<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PepperTech\LaraKeycloak\LaraKeycloak;

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
        $larakeycloak = new LaraKeycloak($socialiteUser);
        
        $user = User::where(['email' => $larakeycloak->user->getEmail()])->first();

        if($user) {
            Auth::login($user);
            return redirect()->intended('home');
        } else{
            $user = User::create([
                'name'          => $larakeycloak->user->getName(),
                'email'         => $larakeycloak->user->getEmail(),
                'password'      => '****',  // not nullable in User Model
            ]);

            Auth::login($user);
            return redirect()->intended('home');
        }
    }
}
