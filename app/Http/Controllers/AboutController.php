<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use App\Http\Requests\AboutForm;
use App\Http\Requests\DeleteAboutForm;
use Illuminate\Support\Facades\Auth;

class AboutController extends Controller
{
    // TODO: Delete remenants of classic form based implementation of About Model
    public function index(){
        $abouts = About::with('user')->get();
        return view('frontview.page.about', compact('abouts') );
    }
    
}
