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

class GithubController extends Controller
{
    use AuthenticatesUsers;
    
    // TODO: Do not authenticate user on a failure
    // TODO: Implement an artisan console command to enable github social provider record.

    /**
     * Redirect to the provider
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGithub()
    {
      // TODO: Check HTTP status Code
      return Socialite::driver('github')->redirect();
    }
    
    /**
     * Obtain the user information from Github.
     * Link with the blog user account
     * Sign the user in
     *
     * TODO: Check if user is enabled 
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGithubCallback()
    {
        try {
            // TODO: Input validation
            // TODO: Provider validation
            
            $socialuser = Socialite::driver('github')->user();
            
            // Check if email exist in input
            $email = $socialuser->getEmail();
            
            if( !isset($email) ){
              // TODO: Log error: Improper Oauth request.
              // TODO: Switch to a more proper response
              session()->flash( 'message', 'E-mail information is required.');
              return redirect()->route('mainpage');
            }
            
            // Check if user exists in blog's users table
            $bloguser = User::where('email',$email)
            ->where('enabled',true)->first();
            
            // TODO: Optimize strings
            
            $messageUserRegClosed = 
            'Thank you for your attention ! '.
            'We are sorry , we can not accept your user registration request. '.
            'Social account registrations are for site management purposes only. '.
            'No non-administrative user registration is allowed at the moment. '.
            'You are not a registered administrator of this site.';
            
            if(!isset($bloguser)){
              session()->flash( 'message', $messageUserRegClosed);
              // TODO: Revoke user consent
              // TODO: Log info : user registration request rejected.
              return redirect()->route('mainpage');
            } 
            
            // Did the user added this providers social user id before
            $newsocialid = new Socialid;
            $newsocialid->socialprovider_id =
              Socialprovider::where('provider','github')->first()->id;
            
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
