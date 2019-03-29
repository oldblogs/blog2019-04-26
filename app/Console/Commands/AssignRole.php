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
     * @var string
     */
    protected $signature = 'permission:assign-role
        {role : The name of the role }
        {email : The email of the user }';

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
     * @param Array
     * @param String
     * @return void
     */
    public function handle()
    {
      try{
        $role = $this->argument('role');
        $email = $this->argument('email');

        if ( is_null($role) || is_null($email) ) {
          throw("Error: Not enough information");
        }
        else {
          $this->info('Role  : '.$role);
          $this->info('User  : '.$email);

          $blogrole = Role::where('name', $role)->firstOrFail();
          $bloguser = User::where('email', $email)->firstOrFail();
          
          if( $bloguser->hasRole($blogrole) ){
            $this->info('User already has the '.$blogrole->name.' role.');
          }
          else{
            $bloguser->assignRole($blogrole);
            $this->info('Role succesfully set.');
          }
          exit;
        }
      }
      catch(Exception $e){
        $this->error('Error: '.$e->message() );
        exit;
      }
    }
}
