<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\User as UserResource;

class LoginController extends Controller
{
    /**
     * 
     * Instantiate a new controller instance.
     * 
     * @return void
     * */
    public function __construct()
    {

        // $this->middleware('log')->only('index');

        $this->middleware('auth.basic.once');
    }

    public function login()
    {
        $Accesstoken = Auth::user()->createToken('Access token')->accessToken;
        return Response(['User' => new UserResource(Auth::user()), 'Access token' => $Accesstoken]);
    }
}
