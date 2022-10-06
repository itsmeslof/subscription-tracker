<?php

namespace App\Observers;

use App\Models\Subscription;
use App\Services\UserService;

class SubscriptionObserver
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the Subscription "created" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function created(Subscription $subscription)
    {
        $this->userService->calculateMonthlyAndAnnualSubscriptionCosts($subscription->user);
    }

    /**
     * Handle the Subscription "updated" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function updated(Subscription $subscription)
    {
        $this->userService->calculateMonthlyAndAnnualSubscriptionCosts($subscription->user);
    }

    /**
     * Handle the Subscription "deleted" event.
     *
     * @param  \App\Models\Subscription  $subscription
     * @return void
     */
    public function deleted(Subscription $subscription)
    {
        $this->userService->calculateMonthlyAndAnnualSubscriptionCosts($subscription->user);
    }
}
