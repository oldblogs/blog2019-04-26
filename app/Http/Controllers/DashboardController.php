<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Dashboard;
use Illuminate\Session\SessionManager;

class DashboardController extends Controller
{
    public function index()
    {
        $bloguser = auth()->user();
        return view('manage.page.index', compact('bloguser') );
    }
}
