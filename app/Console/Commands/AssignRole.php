<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;

class AssignRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * TODO: Remove magic value : web
     * @var string
     */
    protected $signature = 'permission:assign-role 
        {role : The name of the role } 
        {email : The email of the user } 
        {guard=web : The name of the guard}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a role to a User.';

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
     * @param String
     * @param String
     * @param String
     * @return void
     */
    public function handle()
    {
        try{
            $role = $this->argument('role');
            $email = $this->argument('email');
            $guard = $this->argument('guard');

            if ( is_null($role) || is_null($email) ) {
                throw("Error: Not enough information");
            }
            else {
                $this->info('Role  : '.$role);
                $this->info('User  : '.$email);
                $this->info('Guard : '.$guard);
                
                // If a non existing role is entered an error is thrown.
                $blogrole = Role::findByName($role);

                $bloguser = User::where('email', $email)->first();
                if( is_null( $bloguser ) ){
                    throw("User : ".$bloguser." does not exist.");
                }

                // TODO: Implementation for guard option

                $bloguser->syncRoles($blogrole);   
                $this->info('Role succesfully set.');
            }
        }
        catch(Exception $e){
            $this->error('Error: '.$e->message() );
            exit;
        }
    }
}

