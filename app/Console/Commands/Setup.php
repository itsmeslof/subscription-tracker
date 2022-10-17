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

        $this->info('Starting default subscription creation');
        $admin->subscriptions()->create([
            'name' => 'Discord',
            'amount' => '999',
            'billing_cycle_id' => BillingCycle::where('name', 'monthly')->first()->id,
            'color' => '#5662F6',
            'renewal_note' => '1st of the month'
        ]);

        $admin->subscriptions()->create([
            'name' => 'Netflix',
            'amount' => '999',
            'billing_cycle_id' => BillingCycle::where('name', 'monthly')->first()->id,
            'color' => '#E50914',
            'renewal_note' => '15th'
        ]);

        $admin->subscriptions()->create([
            'name' => 'Laracasts',
            'amount' => '9900',
            'billing_cycle_id' => BillingCycle::where('name', 'annually')->first()->id,
            'color' => '#328AF1',
            'renewal_note' => 'April 18th'
        ]);

        $admin->subscriptions()->create([
            'name' => 'Semiannual Subscription Example',
            'amount' => '999',
            'billing_cycle_id' => BillingCycle::where('name', 'semiannually')->first()->id,
            'color' => '#475569'
        ]);

        $admin->subscriptions()->create([
            'name' => 'Hulu',
            'amount' => '1499',
            'billing_cycle_id' => BillingCycle::where('name', 'monthly')->first()->id,
            'color' => '#1CE783',
            'cancelled' => true
        ]);

        $admin->subscriptions()->create([
            'name' => 'Cancelled Subscription',
            'amount' => '4999',
            'billing_cycle_id' => BillingCycle::where('name', 'monthly')->first()->id,
            'color' => '#475569',
            'cancelled' => true
        ]);

        $this->info("Application setup!");
        return 0;
    }
}
