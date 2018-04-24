<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Notifications\PasswordResetbyConsole;

class ResetPassword extends Command
{
    use ResetsPasswords;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password
        {email : The email of the user } ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resets  a user\'s password.';

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
     * @return void
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
                
                do{
                    $password = $this->secret('Enter a password ');
                    $password_confirmation = $this->secret('Enter the password again ');
                    $check = ($password!==$password_confirmation);
                    if($check){
                        $this->info('Entries does not match. Please enter again.');
                    }
                }
                while($check);

                $this->resetPassword($user, $password);
                
                $user->notify(new PasswordResetbyConsole());
                                
                // Notify User by console
                $this->info('Email : '.$email);
                $this->info("User password resetted.");
            }
        }
        catch(Exception $e){
            $this->error('Error: '.$e->message() );
            exit;
        }
    }
}
