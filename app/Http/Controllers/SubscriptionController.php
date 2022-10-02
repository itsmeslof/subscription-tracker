<?php

namespace App\Http\Controllers;

use App\Filters\SubscriptionFilter;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Models\BillingCycle;
use App\Models\Subscription;
use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $subscriptions = $user->subscriptions()->filter($request->only(['status', 'cycle']))->paginate(10)->withQueryString();

        $status = in_array(request()->status, ['active', 'cancelled']) ? request()->status : 'active';
        $cycle = in_array(request()->cycle, ['monthly', 'semiannually', 'annually']) ? request()->cycle : 'all';

        return view('subscriptions.index', [
            'user' => $user,
            'subscriptions' => $subscriptions,
            'status' => $status,
            'cycle' => $cycle
        ]);
    }

    public function create(Request $request)
    {
        return view('subscriptions.create', [
            'availableBillingCycles' => BillingCycle::all(),
        ]);
    }

    public function edit(Request $request, Subscription $subscription)
    {
        return view('subscriptions.edit', [
            'user' => $request->user(),
            'availableBillingCycles' => BillingCycle::all(),
            'subscription' => $subscription
        ]);
    }

    public function store(CreateSubscriptionRequest $request)
    {
        $validated = $request->validated();

        $request->user()->subscriptions()->create($validated);

        return redirect()->route('subscriptions.index');
    }

    public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->update(
            $request->validated()
        );

        return redirect()->route('subscriptions.edit', $subscription)->with('status', 'Subscription updated!');
    }

    public function destroy(Request $request, Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('status', 'Subscription deleted');
    }
}
