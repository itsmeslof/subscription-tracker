<?php

namespace App\Services;

use App\Helpers\MoneyHelper;
use App\Models\User;

class UserService
{
    /**
     * Get the minor cost of the user's active monthly subscriptions.
     *
     * @param User
     *
     * @return int
     */
    private function getMinorCostOfActiveMonthlySubscriptions(User $user): int
    {
        return $user->subscriptions()->active()->monthly()->pluck('amount')->sum();
    }

    /**
     * Get the minor annual cost of the user's active subscriptions.
     *
     * @param User
     *
     * @return int
     */
    private function getMinorCostOfAllActiveSubscriptionsAnnually(User $user): int
    {
        return (
            ($this->getMinorCostOfActiveMonthlySubscriptions($user) * 12) +
            ($user->subscriptions()->active()->semiannually()->pluck('amount')->sum() * 2) +
            $user->subscriptions()->active()->annually()->pluck('amount')->sum()
        );
    }

    /**
     * Calculate the user's total monthly and annual costs, and persist it to the databse.
     *
     * @param User
     */
    public function calculateMonthlyAndAnnualSubscriptionCosts(User $user): void
    {
        $totalMonthlyMinorCost = $this->getMinorCostOfActiveMonthlySubscriptions($user);
        $totalAnnualMinorCost = $this->getMinorCostOfAllActiveSubscriptionsAnnually($user);

        $user->update([
            'total_monthly_minor_cost' => $totalMonthlyMinorCost,
            'total_annual_minor_cost' => $totalAnnualMinorCost
        ]);
    }
}
