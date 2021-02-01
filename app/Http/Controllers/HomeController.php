<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use PepperTech\LaraKeycloak\Token;

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
       
        $user = Socialite::driver('keycloak')->user();
        $decodedToken = Token::decode($user->accessTokenResponseBody['access_token'], env('KEYCLOAK_REALM_PUBLIC_KEY'));
        return get_object_vars($decodedToken);
        
       
        // return view('home');
    }


    
}
