<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ResetPasswordByMail extends Command
{
    use SendsPasswordResetEmails;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password-by-mail
        {email : The email of the user } ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends a reset password e-mail to the user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{
            $email = $this->argument('email');
            
            $user = User::where('email', $email)->first();
            
            if( is_null( $user ) ){
                $this->error('E-mail is not registered.');
                exit();
            }
            else{
                
                $response = $this->broker()->sendResetLink( [ 'email' => $user->email] );
        
                ($response == Password::RESET_LINK_SENT) 
                    ? $this->info("An e-mail with a password reset link is sent to the user.")
                    : $this->error("Error : Email can not be sent.");
                exit();
            }
        }
        catch(Exception $e){
            $this->error('Error : '.$e->message() );
            exit();
        }
    }
    
    /**
     * Get the broker to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker();
    }
}
