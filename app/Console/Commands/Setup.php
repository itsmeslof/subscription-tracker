<?php

namespace App\Console\Commands;

use App\Models\BillingCycle;
use App\Models\User;
use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'st:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the application';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (User::admin()->count()) {
            $this->error("Application has already been setup and an account exists. If you're having trouble logging in, consider resetting your password, or run 'st:reset-admin' to reset the admin account.");
            return;
        }

        $admin = User::factory()->asAdmin()->create();

        $cycles = ['monthly', 'semiannually', 'annually'];

        foreach ($cycles as $cycle) {
            if (BillingCycle::where('name', $cycle)->count()) {
                $this->warn("Biling cycle {$cycle} already exists.");
                continue;
            }

            BillingCycle::create([
                'name' => $cycle
            ]);
        }

        $this->info("Application setup!");
        return 0;
    }
}
