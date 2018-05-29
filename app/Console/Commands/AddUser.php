<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:add';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a User.';

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
            do{
                $email = $this->ask('Please enter your e-mail address ');

                $buser = User::where('email', $email)->first();
                if( !is_null( $buser ) ){
                    $this->error('E-mail is already recorded. User exists.');
                    $email=null;
                }
            }
            while(!$email);

            do{
                $name = $this->ask('Please enter your name ,and surname ');
            }
            while(!$name);

            do{
                $default_role = config('app.default_user_role', 'member');
                $allroles = DB::table('roles')->pluck('name');

                /* TODO: check value of $allroles */
                $allroles = $allroles->toArray();
                $key = array_search($default_role, $allroles);
                $role = $this->choice('Please choose role of the user', $allroles, $key);
            }
            while(!$role);

            // If a non existing role is entered an error is thrown.
            $blogrole = Role::findByName($role);

            do{
                $password = $this->secret('Enter a password ');
                $password_confirmation = $this->secret('Enter the password again ');
            }
            while($password!==$password_confirmation);

            $encrypted_password = bcrypt($password);

            $this->info('Email : '.$email);
            $this->info('Name  : '.$name);
            $this->info('Role  : '.$role);

            $bloguser = new User;
            $bloguser->name = $name;
            $bloguser->email = $email;
            /* TODO: Cancel direct password setting .
               Set the password to something random, than send an
               activation / password reset email.
            */
            $bloguser->password = $encrypted_password;
            $bloguser->enabled = true;
            $bloguser->save();

            $this->info("A new user created successfully.");

            $bloguser->syncRoles($blogrole);
            $this->info('Role succesfully set.');
        }
        catch(Exception $e){
            $this->error('Error: '.$e->message() );
            exit;
        }
    }
}
