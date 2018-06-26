<?php

namespace App\Http\Requests;

use App\User;
use App\Csocial;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteCsocialForm extends FormRequest
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
        return [ 'id' => 'required|integer' ];
    }
    
    /**
     * Delete a social contact record.
     * 
     * @return void
     */
    public function delete(Csocial $csocial){
        try{
            $csocial->delete();
            session()->flash( 'message', 'Social contact record has been deleted.' );
        }
        catch(\Exception $e){
            //TODO: Log
            session()->flash( 'error', 'Social contact record can not be deleted.' );
        }
    }
}
