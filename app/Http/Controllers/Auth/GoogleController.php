<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Response;
use Socialite;
use Exception;
use App\Socialprovider;
use App\Socialid;
use Carbon\Carbon;

class GoogleController extends Controller
{
    use AuthenticatesUsers;

    // TODO: Do not authenticate user on a failure

    // TODO: Implement a different message for account verified but waiting permission assignment
    
    /**
     * Redirect to the provider
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
      // TODO: Check HTTP status Code
      return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     * Link with the blog user account
     * Sign the user in
     *
     * TODO: Check if user is enabled 
     * 
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
      try {
        // TODO: Input validation
        // TODO: Provider validation

        $socialuser = Socialite::driver('google')->user();
        
        // Check if email exist in input
        $email = $socialuser->getEmail();
        
        if(!isset($email)){
          // TODO: Log error: Improper Oauth request.
          session()->flash( 'message', 'E-mail information is required.');
          return redirect()->route('mainpage');
        }
        
        // Check if user exists in our users table
        $bloguser = User::where('email',$email)
          ->where('enabled',true)->first();
        
        $messageUserRegClosed = 'Sorry ! Social account registrations are '.
        'for site management purposes only.'.
        'No user registration is allowed at the moment.'.
        'Your are not a registered administrator of this site.';

        if(!isset($bloguser)){
          session()->flash( 'message', $messageUserRegClosed);
          // TODO: Revoke user consent
          // TODO: Log info : user registration request rejected.
          return redirect()->route('mainpage');
        } 

        // Did the user added this providers social user id before
        $newsocialid = new Socialid;
        $newsocialid->socialprovider_id =
          Socialprovider::where('provider','google')->first()->id;
        
        $newsocialid->socialid = $socialuser->getId();
        $count=Socialid::where('socialprovider_id', $newsocialid->socialprovider_id)
          ->where('socialid', $newsocialid->socialid)
          ->where('user_id', $bloguser->id)->count();
        
        $expiretime = Carbon::now();
        $expiretime->addSeconds($socialuser->expiresIn);
          
        if($count>1){
          // TODO: Handle with care
          // TODO: Raise a proper error
          // TODO: Log fatal error: Non unique social id spotted.
          session()->flash( 'message', 'Sorry ! An error occured. ' );
          return redirect()->route('mainpage');
        } 
        elseif($count===1){
          // The same social id is in blog database
          // Update existing social id's changed values
          $activeSocialId = Socialid::where('socialprovider_id', $newsocialid->socialprovider_id)
            ->where('socialid', $newsocialid->socialid)
            ->where('user_id', $bloguser->id)->first();
          $activeSocialId->accesstoken = $socialuser->token;
          $activeSocialId->expires_at = $expiretime;
          $activeSocialId->save();
          // TODO: Log info: Existing social id updated
        }
        else{
          // No social id linked before
          // Save the new social id
          $newsocialid->accesstoken = $socialuser->token;
          $newsocialid->expires_at = $expiretime;
          $newsocialid->user_id = $bloguser->id;
          $newsocialid->save();

          session()->flash( 'message',
            'Your social account has been successfully '.
            'linked to your blog account.' );
          // TODO: Log info: New social id linked to a user account
        }

        // TODO : Implement a new guard named : admin
        // TODO : Give all permisssions to admin like web at the moment
        // TODO : Switch all web guards to admin guard
        // TODO : Revoke all permissions from web guard, 
        //        give them to admin guard
        
        // Log the user in
        if (!Auth::check()) {
          Auth::guard('web')->login($bloguser);
          
          // TODO: Log info: User is authenticated
          session()->flash( 'message', 'You are successfully logged in.' );
        }
        
        return redirect()->route('home');
        
      } catch (Exception $e) {
        if (config('app.env')==='local'){
          session()->flash( 'message', $e->getMessage() );
        } else {
          session()->flash( 'message', 'Error' );
        }
        
        return redirect()->route('mainpage');
      }

    }
}
