<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserPasswordController extends Controller
{
    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string']
        ]);

        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['Current password is incorrect'], 'password');
        }

        $request->user()->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status.user_password', 'Password updated');
    }
}
