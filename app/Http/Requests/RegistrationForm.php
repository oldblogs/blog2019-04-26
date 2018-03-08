<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\Welcome;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
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
        // TODO: Proper User Input Validation
        
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ];
    }
    
    public function persist()
    {
        // Thanks Adrian for your comment
        // "You should use $this->name, $this->email and bcrypt($this->password)."
        $user = User::create([ 
                    'name' => $this->name, 
                    'email' => $this->email,
                    'password' => bcrypt($this->password)
                ]);
        
        auth()->login($user);
        
        Mail::to($user)->send(new Welcome($user));
    }

}
