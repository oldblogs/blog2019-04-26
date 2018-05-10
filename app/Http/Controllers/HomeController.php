<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;

class HomeController extends Controller
{
    public function index()
    {
        $bloguser = auth()->user();
        return view('manage.page.home', compact('bloguser') );
    }
}
