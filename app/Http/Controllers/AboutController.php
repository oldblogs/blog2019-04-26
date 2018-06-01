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
    
    public function index_m(){
        $abouts = About::all();
        return view('manage.page.abouts.indexm', compact('abouts') );
    }
    
    public function create()
    {
        return view('manage.page.abouts.create');
    }
    
    public function store(AboutForm $form)
    {
        $form->persist();
        
        return redirect()->route('abouts.index.m');
    }
    
    public function show(About $about)
    {
        return view('manage.page.abouts.show', compact('about') );
    }
    
    public function edit(About $about)
    {
        return view('manage.page.abouts.edit', compact('about') );
    }
    
    public function update(AboutForm $form,About $about)
    {
        $form->update($about);

        return redirect()->route('abouts.index.m');
    }
    
    public function delete(DeleteAboutForm $form, About $about)
    {
        $form->delete($about);
        
        return redirect()->route('abouts.index.m');
    }
    
    
}
