<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Clarkeash\Doorman\Facades\Doorman;
use Clarkeash\Doorman\Models\Invite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm($code, $email)
    {
        try{
            if (Doorman::check($code, $email) ){
                return view('auth.register', compact('code', 'email') );
            }
            else{
                // TODO: Proper error message. Log for fail2ban.
                abort(404);
            }
        }
        catch(Exception $e){
            // TODO: Proper error message. Log for fail2ban.
            abort(404);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'code' => ['required', 'alpha_num'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // TODO: input validation
        $dummyx = $data;
        try{
            Doorman::redeem($data['code'], $data['email']);
        }
        catch(Exception $e){
            // TODO: Proper error message. Log for fail2ban.
            abort(404);
        }

        try{
            return User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }
        catch(Exception $e){
            // TODO: Proper error message. Log for fail2ban.
            abort(404);
        }
    }
}
