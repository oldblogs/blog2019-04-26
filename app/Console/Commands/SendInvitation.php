<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Clarkeash\Doorman\Facades\Doorman;
use Carbon\Carbon;
use Clarkeash\Doorman\Models\Invite;
use App\Mail\InviteCreated;
use Illuminate\Support\Facades\Mail;

class SendInvitation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'invitation:send
        {email : The email of the person } ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends an invitation to a person.';

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
     * @return void
     */
    public function handle()
    {
        try{
            $useless = Invite::useless()->count();
            if($useless > 0){
                Invite::useless()->delete();
                $this->info('Successfully deleted ' . $useless . ' expired invites from the database.');
            }

            $email = $this->argument('email');

            if ( Invite::where('for', $email)->count() > 0 ) {
                $this->info('There is already an invitation for this user.');
                exit();
            }
            else{
                $date = Carbon::now('UTC')->addDays(1);
                $invitation = Doorman::generate()->for($email)->expiresOn($date)->make()->first();
                // send an email
                Mail::to($email)->send(new InviteCreated($invitation));
                $this->info('Successfully send one invitation.');
            }
        }
        catch(Exception $e){
            // TODO: Check proper error message handling
            $this->error('Error : '.$e->message() );
            exit();
        }
    }
    
}
