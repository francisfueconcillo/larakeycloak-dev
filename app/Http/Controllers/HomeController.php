<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use PepperTech\LaraKeycloak\LaraKeycloak;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try{
            $socialiteUser = Socialite::driver('keycloak')->userFromToken(session('token'));
            session([
                'token' => $socialiteUser->token,
            ]); 
        } catch(\Exception $e) {
            return redirect()->route('auth-redirect');
        }
        
        return view('home');
    }
}
