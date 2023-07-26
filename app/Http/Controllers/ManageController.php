<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Session\SessionManager;

class ManageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    // TODO: Delete before production
    public function test(User $user){
        return view('manage.page.test', compact('user') );
    }
}
