<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use App\Socialprovider;
use Illuminate\Support\Facades\DB;

class Socialid extends Model
{
  // TODO: User can revoke permissions.
  // TODO: remove revoked accounts . 
  
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
      'accesstoken', 'socialid', 'tokensecret',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function socialprovider(){
        return $this->belongsTo(Socialprovider::class);
    }

    // Thanks: https://stackoverflow.com/questions/44344834/check-whether-laravel-controller-action-is-defined
    public static function action_exists($action) {
      try {
          action($action);
      } catch (\Exception $e) {
          return false;
      }
  
      return true;
    }
    
    /**
     * Check which social login providers are available for the current authenticated user
     *
     * @return mixed $availableSP
     */
    public static function availableProviders(){
      // This is not a good implementation.
      // Could not find a shorter way in the docs
      // I am open to suggestions.

      $usedSocialLogins = Socialid::select('socialprovider_id')
                            ->where( 'user_id', Auth::id() )
                            ->groupBy( 'socialprovider_id' )
                            ->get();
      
      $usedSocialLoginsArr = [];
      
      if ( isset($usedSocialLogins) && count($usedSocialLogins) ) {
        foreach($usedSocialLogins as $social){
          $usedSocialLoginsArr[] = $social->socialprovider_id;
        }
      }
      
      // Social Providers that are not linked to the authenticated user:
      //
      // This gets values from database (socialids table ) but the blog 
      // must be properly set to use social logins:
      // 1 . User must be already registered via artisan user:add command . 
      // 2 . User must be enabled and attached to admin role (for version 0.2.0) 
      // 3 . Emails must match in users table and social login. Emails must be verified.
      // 4 . Related social login provider must be configured properly (Provider side client creation)
      // 5 . You must have your client ID and password entered in .env file
      // 6 . /config/services.php must be configured
      // 7 . /routes/web.php must be configured
      // 8 . A Controller for the social provider must be created.
      // 9 . Provider must be defined in socialproviders table, and enabled there.
      // If all above is done then we can use the social logins
      
      $availableSP = 
        Socialprovider::where('enabled',true)->whereNotIn('id', $usedSocialLoginsArr)->get()->values()->toArray();

      // TODO: Document string conventions related to social logins

      if( isset($availableSP) && count($availableSP) ){
        for ($i = 0; $i < count($availableSP); $i++){
          $provider = $availableSP[$i]['provider'];
          
          if( ( null !== config('services.' . $provider . '.client_id') ) && 
              ( null !== config('services.' . $provider . '.client_secret') ) &&
              Socialid::action_exists('Auth\\' . ucfirst($provider) . 'Controller@redirectTo' . ucfirst($provider) ) && 
              Socialid::action_exists('Auth\\' . ucfirst($provider) . 'Controller@handle' . ucfirst($provider) . 'Callback')
            ) {
              $availableSP[$i]['auth_endpoint'] = route($provider . '_auth_endpoint');
          }
          else {
            // Provider set in socialproviders table but configuration files are not ready
            // TODO: Raise error - Misconfiguration
            // TODO: Log the error
            abort(500, 'Server error.');
          }
        }

        return $availableSP;
      }

      // where no Social Provider is configured or all of them are used.
      return null;
    }
    
}
