<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\MoneyHelper;
use Brick\Math\RoundingMode;
use Brick\Money\Context\DefaultContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Make the user an administrator.
     */
    public function setAsAdmin(): void
    {
        $this->update(['is_admin' => true]);
    }

    /**
     * Get the subscriptions belonging to the user.
     *
     * @return hasMany
     */
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get the minor cost of the user's active monthly subscriptions.
     *
     * @return int
     */
    private function getMinorCostOfActiveMonthlySubscriptions(): int
    {
        return $this->subscriptions()->active()->monthly()->pluck('amount')->sum();
    }

    /**
     * Get the minor annual cost of the user's active subscriptions.
     *
     * @return int
     */
    private function getMinorCostOfAllActiveSubscriptionsAnnually(): int
    {
        return (
            ($this->getMinorCostOfActiveMonthlySubscriptions() * 12) +
            ($this->subscriptions()->active()->semiannually()->pluck('amount')->sum() * 2) +
            $this->subscriptions()->active()->annually()->pluck('amount')->sum()
        );
    }

    /**
     * Get the cost of the user's active monthly subscriptions as a formatted currency string.
     *
     * @return string
     */
    public function getFormattedMonthlySubscriptionCost(): string
    {
        $money = MoneyHelper::createMoneyOfMinor($this->getMinorCostOfActiveMonthlySubscriptions());
        return $money->formatTo('en_US');
    }

    /**
     * Get the annual cost of the user's active subscriptions as a formatted currency string.
     *
     * @return string
     */
    public function getFormattedAnnualSubscriptionCost(): string
    {
        $money = MoneyHelper::createMoneyOfMinor($this->getMinorCostOfAllActiveSubscriptionsAnnually());
        return $money->formatTo('en_US');
    }
}
