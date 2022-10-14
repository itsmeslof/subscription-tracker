<?php

namespace App\Http\Controllers;

use App\Actions\Action;
use App\Actions\Settings\General\UpdateGeneralSettings;
use App\Http\Requests\UpdateGeneralSettingsRequest;

class UpdateGeneralSettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\UpdateGeneralSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateGeneralSettingsRequest $request)
    {
        Action::call(
            UpdateGeneralSettings::class,
            $request->user(),
            $request->validated()
        );

        return back()->with('status:settings:general', 'Settings Updated');
    }
}
