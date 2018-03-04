<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;
use Illuminate\Session\SessionManager;

class RegistrationsController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }
    
    public function store(RegistrationForm $form)
    {
        $form->persist();
        
        session()->flash('message', 'Thanks so much for signing up!');
        
        return redirect()->home();
    }
}
