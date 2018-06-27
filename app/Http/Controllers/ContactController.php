<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{

    public function index(){
        $cContent = [];
        return view('manage.page.contacts.index', compact('cContent') );
    }

}
