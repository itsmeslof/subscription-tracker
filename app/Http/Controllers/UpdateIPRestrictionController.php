<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateIPRestrictionRequest;

class UpdateIPRestrictionController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Requests\UpdateIPRestrictionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(UpdateIPRestrictionRequest $request)
    {
        $request->user()->update($request->validated());

        return back()->with('status:settings:ipAccess', 'IP Access Settings Updated');
    }
}
