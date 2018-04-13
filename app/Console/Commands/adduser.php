<?php

namespace App\Console\Commands;

use App\User;

use Illuminate\Console\Command;

class adduser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'adduser {email : Email of the user} {name : Name of the User(Use " or \')}';
    protected $signature = 'adduser';
    
    /**
     * Add a new user.
     * Example: 
     * php artisan adduser john@example.com "John Doe"
     * 
     * @var string
     */
    protected $description = 'Add a new user '.
    'Example: php artisan adduser john@example.com "John Doe"';

    /**
     * User info
     *
     * @var User
     */
    protected $newUser;
    
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
        $email = $this->ask('Please enter your e-mail address ?');
        $name = $this->ask('Please enter your name and surname ?');
        $password = $this->secret('Enter a password ?');
        $password2 = $this->secret('Enter the password again');
        $encrypted_password = "";
        
        try {
            // TODO: User input validation
            if ($password===$password2) {
                $encrypted_password = bcrypt($password);
                $this->newuser = new User([
                    'name' => $name,
                    'email' => $email,
                    'password' => $encrypted_password
                ]);
            }
            $this->newuser->save();
            $this->comment("Kullanıcı başarıyla oluşturuldu.");
        }
        catch (Exception $e){
            $this->comment("Hata: Kullanıcı oluşturulamadı.");
        }
    }
}
