<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(Request $request)
    {
        return view('user.edit', [
            'user' => $request->user()
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validateWithBag('details', [
            'username' => ['sometimes', 'required', 'string'],
            'email' => ['sometimes', 'required', 'email']
        ]);

        $request->user()->update($validated);

        return back()->with('status:account_settings', 'Account details updated');
    }
}
