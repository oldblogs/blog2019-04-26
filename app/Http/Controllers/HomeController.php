<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Socialid;
use App\Socialprovider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $bloguser = $request->user()
                        ->where( 'id',Auth::id() )
                        ->with( 'socialids.socialprovider' )->first() ;
        
        // Available social providers
        $availableps = Socialid::availableProviders();
        
        return view('manage.page.home', compact('bloguser', 'availableps') );
    }
}