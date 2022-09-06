<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

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

        $this->call([
            BillingCycleSeeder::class
        ]);
    }


    private function createAdminAccount()
    {
        User::factory()->asAdmin()->create();
    }
}
