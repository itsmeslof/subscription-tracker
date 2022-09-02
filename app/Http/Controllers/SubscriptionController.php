<?php

namespace App\Http\Controllers;

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
	public function index() {}

	public function create(Request $request)
	{
		return view('subscriptions.create', [
			'availableBillingCycles' => BillingCycle::all(),
		]);
	}

	public function edit(Request $request, Subscription $subscription)
	{
		return view('subscriptions.update', [
			'user' => $request->user(),
			'availableBillingCycles' => BillingCycle::all(),
			'subscription' => $subscription
		]);
	}

	public function store(CreateSubscriptionRequest $request)
	{
		$validated = $request->validated();
	
		return redirect()->route('subscriptions.index');
	}

	public function update(UpdateSubscriptionRequest $request, Subscription $subscription)
	{
		$subscription->update(
			$request->validated()
		);

		return redirect()->route('subscriptions.index');
	}

	public function destroy(Request $request, Subscription $subscription)
	{
		$subscription->delete();

		return redirect()->route('subscriptions.index');
	}
}
