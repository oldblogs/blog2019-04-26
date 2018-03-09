<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'destroy']);
    }
    
    
    public function create()
    {
        return view('frontview.page.sessions.create');
    }
    
    public function store()
    {
        // TODO: User input validation.
        $this->validate(request(),[
            'email' => 'required|max:200',
            
            'password' => 'required|min:1|max:1000'
            
        ]);
                
        // Attempt to authenticate the user.
        if (! auth()->attempt( request(['email', 'password']) ) ) {
            return back()->withErrors([
                'message' => 'Please check your credentials and try again.'
            ]);
        }
        
        return redirect()->route('manage');
    }
    
    public function destroy()
    {
        auth()->logout();
        
        return redirect()->home();
        
    }
}
