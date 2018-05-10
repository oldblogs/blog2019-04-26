<?php

namespace App\Http\Requests;

use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class DeleteForm extends FormRequest
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
     * Delete the post.
     * 
     * @return void
    */
    public function delete(Post $post)
    {
        auth()->user()->deletePost( $post );
        session()->flash( 'message', 'Post has been deleted.' );
    }
    
}
