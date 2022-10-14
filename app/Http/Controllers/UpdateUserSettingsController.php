<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserSettingsRequest;

class UpdateUserSettingsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\UpdateUserSettingsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateUserSettingsRequest $request)
    {
        $request->user()->update($request->validated());

        return back()->with('status:settings:general', 'Settings Updated');
    }
}
