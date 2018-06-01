<?php

namespace App\Http\Requests;

use App\User;
use App\About;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteAboutForm extends FormRequest
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
        // TODO: User input validation
        return [
            'id' => 'required|integer'
        ];
    }
    
    /**
     * Delete the about record.
     * 
     * @return void
     */
    public function delete(About $about){
        
        try{
            $about->delete();
            session()->flash( 'message', 'About record has been deleted.' );
        }
        catch(\Exception $e){
            // TODO: Log
            session()->flash( 'message', 'About record can not be deleted.' );
        }
        
    }
    
}
