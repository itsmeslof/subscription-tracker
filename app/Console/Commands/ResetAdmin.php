<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'st:reset-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset the admin account';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::admin()->first();

        if (is_null($admin)) {
            $admin = User::factory()->asAdmin()->create();
        } else {
            $admin->update([
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password')
            ]);
        }

        $this->info("Admin account reset");
        return 0;
    }
}
