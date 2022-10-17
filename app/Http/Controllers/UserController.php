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
        return back();
    }
}
