<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dashboard;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $bloguser = Auth::user();
        return view('manage.page.index', compact('bloguser') );
    }
}
