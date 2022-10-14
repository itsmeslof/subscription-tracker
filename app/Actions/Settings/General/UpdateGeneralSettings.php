<?php

namespace App\Actions\Settings\General;

use App\Models\User;
use App\Models\UserGeneralSettings;

class UpdateGeneralSettings
{
    /**
     * Update the user's general settings.
     *
     * @param User $user
     * @param array $data
     *
     * @return UserGeneralSettings
     */
    public function execute(User $user, array $data): UserGeneralSettings
    {
        $generalSettings = $user->generalSettings; // creates a default if it doesn't exist
        $generalSettings->update($data);

        return $generalSettings;
    }
}
