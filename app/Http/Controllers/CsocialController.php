<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Csocial;
use App\Http\Requests\CsocialForm;
use App\Http\Requests\DeleteCsocialForm;
use Carbon\Carbon;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Auth;

class CsocialController extends Controller
{
    public function index(){
        $csocials = Csocial::all();
        return view('manage.page.csocials.index', compact('csocials'));
    }
    
    public function create()
    {
        return view('manage.page.csocials.create');
    }
    
    public function store(CsocialForm $form)
    {
        $form->persist();
        
        return redirect()->route('csocials.index');
    }
    
    public function show(Csocial $csocial)
    {
        return view('manage.page.csocials.show', compact('csocial') );
    }
    
    public function edit(Csocial $csocial)
    {
        return view('manage.page.csocials.edit', compact('csocial'));
    }
    
    public function update(CsocialForm $form, Csocial $csocial)
    {
        //dd($csocial);
        $form->update($csocial);
        
        return redirect()->route('csocials.index');
    }
    
    public function delete(DeleteCsocialForm $form, Csocial $csocial)
    {
        $form->delete($csocial);
        
        return redirect()->route('csocials.index');
    }
    
}
