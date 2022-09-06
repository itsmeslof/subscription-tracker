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

		// If we were to implement remember_me then it would be a good idea to reset the remember_token here, which would cause other sessions on other devices to have to login again. However since we don't implement that, we don't need to worry.
		$request->user()->update([
			'password' => Hash::make($request->new_password)
		]);

		return back()->with('status.user_password', 'Password updated');
	}
}
