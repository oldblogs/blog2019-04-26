<?php

namespace App\Http\Requests;

use App\User;
use App\Csocial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CsocialForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order' => 'required|integer|min:1|max:1024',
            'title' => 'required|min:3|max:250',
            'css_class' => 'required|min:3|max:250',
            'homepage' => 'required|min:3|max:250'
        ];
    }
    
    /**
     * Save form values to database
     * 
     * @return void
     */
    public function persist(){
        try{
            $csocials = new Csocial( request(['order', 'title', 'css_class', 'homepage' ]) );
            
            if( $csocials->save() ){
                session()->flash( 'message', 'Social network saved.' );
            }
            else{
                session()->flash( 'error', 'Social network can not be saved.' );
            }
        }
        catch(\Exception $e){
            // TODO: Log
            // TODO: Change error message
            session()->flash( 'error', 'An error occured' );
        }
    }
    
    
    /**
     * Update Social contact record.
     * 
     * @return void
     */
    public function update(Csocial $csocial){
        try{
            $csocial->order = request('order');
            $csocial->title = request('title');
            $csocial->css_class = request('css_class');
            $csocial->homepage = request('homepage');
            
            if ( $csocial->save() ){
                session()->flash( 'message', 'Social network updated.' );
            }
            else{
                session()->flash( 'error', 'Social network can not be updated.' );
            }
            
        }
        catch(\Exception $e){
            // TODO: Log
            // TODO: Change error message
            session()->flash( 'error', 'An error occured.' );
        }
    }
    
}
