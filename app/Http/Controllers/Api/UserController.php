<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Session\SessionManager;

class UserController extends Controller
{
    public function index(){
        return response()->json( auth()->user() );
    }
}
