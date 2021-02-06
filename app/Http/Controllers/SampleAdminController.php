<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PepperTech\LaraKeycloak\LaraKeycloak;

class SampleAdminController extends Controller
{
    public function index()
    {

        if (! Gate::allows('view-admin')) {
            abort(403);
        }

        return view('sample_admin');
    }
}
