<?php

namespace App\Http\Requests;

use App\User;
use App\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Rules\Checkbox;
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
            'title' => 'required|min:2|max:250',
            'body' => 'required|min:2|max:10000',
            new Checkbox
        ];
    }
    
    /**
     * Save form values to database
     * 
     * @return void
     */
    public function persist(){

        $post = new Post( request(['title', 'body']) );
        
        $published = request(['published']);
        
        if ( isset($published) && $published ){
            $post->published = 1;
        }
        else{
            $post->published = 0;
        }
        
        Auth::user()->publish($post);
        
        if ( $post->published ){
            session()->flash(
                'message', 'Your post has now been published.'
            );
        }
        else{
            session()->flash(
                'message', 'Your post has now been saved.'
            );
        }
    }
    
    /**
     * Update the post.
     * 
     * @return void
     */
    public function update(Post $post){

        $post->title = request('title');
        $post->body = request('body');
        $published = request('published');

        if ( isset($published) && $published ){
            $post->published = 1;
        }
        else{
            $post->published = 0;
        }

        Auth::user()->update_post( $post );

        session()->flash(
            'message', 'Your post has now been updated'
        );
    }
    
}
