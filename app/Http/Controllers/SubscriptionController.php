<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\BillingCycle;
use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    private $subscriptionService;

    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    public function index(Request $request): View
    {
        $user = $request->user();

        $subscriptions = $this->subscriptionService
            ->getSubscriptionsWithFilters($request)
            ->paginate(10)
            ->withQueryString();

        $filterData = $this->subscriptionService
            ->getSubscriptionFilterData($request);

        return view('subscriptions.index', [
            'user' => $user,
            'subscriptions' => $subscriptions,
            'filterData' => $filterData
        ]);
    }

    public function create(Request $request): View
    {
        return view('subscriptions.create', [
            'availableBillingCycles' => BillingCycle::all(),
        ]);
    }

    public function edit(Request $request, Subscription $subscription): View
    {
        return view('subscriptions.edit', [
            'user' => $request->user(),
            'availableBillingCycles' => BillingCycle::all(),
            'subscription' => $subscription
        ]);
    }

    public function store(CreateSubscriptionRequest $request): RedirectResponse
    {
        $this->subscriptionService->store($request->user(), $request->validated());

        return redirect()->route('subscriptions.index')->with('status', 'Subscription added!');
    }

    public function update(CreateSubscriptionRequest $request, Subscription $subscription): RedirectResponse
    {
        $this->subscriptionService->update($subscription, $request->validated());

        return redirect()->route('subscriptions.edit', $subscription)->with('status', 'Subscription updated!');
    }

    public function destroy(Request $request, Subscription $subscription): RedirectResponse
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('status', 'Subscription deleted');
    }
}
