<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateGlobalSiteSettingsRequest;
use App\Models\GlobalSiteSettings;

class GlobalSiteSettingsController extends Controller
{
    public function index()
    {
        return view('admin.site-settings', [
            'settings' => GlobalSiteSettings::first()
        ]);
    }

    public function update(UpdateGlobalSiteSettingsRequest $request)
    {
        GlobalSiteSettings::get()->update($request->validated());

        return back()->with('status:settings:global', 'Site Settings Updated!');
    }
}
