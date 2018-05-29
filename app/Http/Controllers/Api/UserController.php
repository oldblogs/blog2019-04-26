<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return response()->json( Auth::user() );
    }
}
