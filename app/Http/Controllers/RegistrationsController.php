<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;

class RegistrationsController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }
    
    public function store(RegistrationForm $form)
    {
        $form->persist();
        
        return redirect()->home();
    }
}
