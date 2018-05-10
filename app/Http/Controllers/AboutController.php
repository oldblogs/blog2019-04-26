<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\About;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;

class AboutController extends Controller
{
    public function show(About $ctvalue)
    {
        return view('frontview.page.about', compact('ctvalue') );
    }
}
