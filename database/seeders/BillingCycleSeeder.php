<?php

namespace Database\Seeders;

use App\Models\BillingCycle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class BillingCycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cycles = ['monthly', 'semiannually', 'annually'];

        foreach ($cycles as $cycle) {
            if (BillingCycle::where('name', $cycle)->count()) {
                Log::warning("Biling cycle {$cycle} already exists.");
                continue;
            }

            BillingCycle::create([
                'name' => $cycle
            ]);
        }
    }
}
