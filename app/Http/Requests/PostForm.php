<?php

namespace App\Http\Requests;

use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PostForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::check()) {
            // The user is logged in...
            return true;
        }
        else{
            return false;
        }
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
            'title' => 'required|min:2|max:200',
            'body' => 'required|min:2|max:1000'
        ];
    }
    
    public function persist(){
        auth()->user()->publish(
            new Post( request(['title', 'body']) )
        );
        
        session()->flash(
            'message', 'Your post has now been published'
        );
    }
}
