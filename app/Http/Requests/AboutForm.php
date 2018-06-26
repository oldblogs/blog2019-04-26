<?php

namespace App\Http\Requests;

use App\User;
use App\About;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AboutForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Authorization is done at routing stage
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // TODO: Proper input validation
        return [
            'title' => 'required|min:2|max:250',
            'subtitle' => 'required|min:2|max:250',
            'body' => 'required|min:2|max:10000',
            'photo' => 'min:2|max:250',
        ];
    }
    
    /**
     * Save form values to database
     * 
     * @return void
     */
    public function persist(){

        try{
            
            $about = new About( request(['title', 'subtitle', 'body']) );
            
            // TODO: Implement photo
            
            if ( $about->save() ){
                session()->flash( 'message', 'About entry saved.' );
            }
            else{
                session()->flash( 'message', 'About entry can not be saved.' );
            }
        }
        catch(\Exception $e){
            // TODO: Log
            // TODO: Change error message
            session()->flash( 'message', 'An error ocurred' );
        }
    }
    
    /**
     * Update about record.
     * 
     * @return void
     */
    public function update(About $about){
        
        try{
            // TODO: Implement photo
            $about->title = request('title');
            $about->subtitle = request('subtitle');
            $about->body = request('body');

            if ( $about->save() ){
                session()->flash( 'message', 'About record updated.' );
            }
            else{
                session()->flash( 'message', 'About record can not be updated.' );
            }
        }
        catch(\Exception $e){
            // TODO: Log
            // TODO: Change error message
            session()->flash( 'message', 'An error ocurred' );
        }
    }
    
}




    


