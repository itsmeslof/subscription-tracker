<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\GlobalSiteSettings;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdminAccount();
        $this->createGlobalSiteSettings();

        $this->call([
            BillingCycleSeeder::class
        ]);
    }

    private function createAdminAccount()
    {
        if (User::admin()->count()) {
            Log::warning("Can't crate admin account - one already exists!");
            return;
        }

        User::factory()->asAdmin()->create();
    }

    private function createGlobalSiteSettings()
    {
        if (GlobalSiteSettings::count()) {
            Log::warning("Can't create GlobalSiteSettings - an instance already exists!");
            return;
        }

        GlobalSiteSettings::create();
    }
}
