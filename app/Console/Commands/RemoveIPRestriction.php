<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RemoveIPRestriction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'st:remove-ip-restriction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the IP Access Restriction';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $admin = User::admin()->first();

        if ($admin) {
            $admin->update([
                'restrict_ip_access' => false,
                'allowed_ip' => null
            ]);
            $this->info('IP Access Restriction Removed!');
        }

        return 0;
    }
}
