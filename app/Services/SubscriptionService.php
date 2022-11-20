<?php

namespace App\Services;

use App\Exceptions\InvalidSubscriptionAmountException;
use App\Helpers\MoneyHelper;
use App\Models\Subscription;
use App\Models\User;
use Brick\Math\Exception\NumberFormatException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SubscriptionService
{
    /**
     * Persist a new Subscription model to the databse.
     *
     * @param User $user
     * @param array $subscriptionData
     */
    public function store(User $user, $subscriptionData): void
    {
        $minorAmount = $this->tryConvertAmountToMinor($subscriptionData['amount']);
        $this->ensureAmountUnderLimit($minorAmount);

        $subscriptionData['amount'] = $minorAmount;
        $user->subscriptions()->create($subscriptionData);
    }

    /**
     * Update an existing Subscription model.
     *
     * @param Subscription $subscription
     * @param array $subscriptionData
     */
    public function update(Subscription $subscription, $subscriptionData): void
    {
        $minorAmount = $this->tryConvertAmountToMinor($subscriptionData['amount']);
        $this->ensureAmountUnderLimit($minorAmount);

        $subscriptionData['amount'] = $minorAmount;
        $subscription->update($subscriptionData);
    }

    /**
     * Get the user's subscriptions with query string filters applied.
     *
     * @param Request $request
     *
     * @return HasMany
     */
    public function getSubscriptionsWithFilters(Request $request): HasMany
    {
        $user = $request->user();
        $subscriptions = $user->subscriptions()->filter(
            $request->only(['status', 'cycle'])
        );

        return $subscriptions;
    }

    /**
     * Get the filter data for the current request.
     *
     * @param Request $request
     *
     * @return Collection
     */
    public function getSubscriptionFilterData(Request $request): Collection
    {
        $status = in_array($request->status ?? null, ['active', 'cancelled']) ? request()->status : 'active';
        $cycle = in_array($request->cycle ?? null, ['monthly', 'semiannually', 'annually']) ? request()->cycle : 'all';

        return collect([
            'status' => $status,
            'cycle' => $cycle
        ]);
    }

    /**
     * Convert a numeric value to a minor currency value.
     *
     * @param string|int $amount
     *
     * @throws InvalidSubscriptionAmountException
     *
     * @return int
     */
    private function tryConvertAmountToMinor(string|int $amount): int
    {
        try {
            $minorAmount = MoneyHelper::createMoney($amount)->getMinorAmount()->toInt();
        } catch (NumberFormatException $e) {
            throw new InvalidSubscriptionAmountException('The amount must be a number.');
        }

        return $minorAmount;
    }

    /**
     * Ensures that the provided minor amount is not greater than the allowed maximum integer value in the database.
     *
     * @param int $minorAmount
     *
     * @throws InvalidSubscriptionAmountException
     */
    private function ensureAmountUnderLimit(int $minorAmount): void
    {
        if ($minorAmount > Subscription::MAX_MINOR_AMOUNT) {
            $formattedMaxAmount = MoneyHelper::formatMinor(Subscription::MAX_MINOR_AMOUNT);
            throw new InvalidSubscriptionAmountException('The maximum amount allowed is ' . $formattedMaxAmount);
        }
    }
}
