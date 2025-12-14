<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeDataAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:data-access {email : The email of the user to give data access}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give a user data access';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->update(['data_access' => true]);

        $this->info("User {$user->name} ({$user->email}) has been given data access.");

        return 0;
    }
}