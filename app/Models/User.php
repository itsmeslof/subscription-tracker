<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Brick\Math\RoundingMode;
use Brick\Money\Context\DefaultContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function setAsAdmin()
    {
        $this->update(['is_admin' => true]);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function getMinorCostOfActiveMonthlySubscriptions()
    {
        return $this->subscriptions()->active()->monthly()->pluck('amount')->sum();
    }

    public function getMinorCostOfAllActiveSubscriptionsAnnually()
    {
        return (
            ($this->getMinorCostOfActiveMonthlySubscriptions() * 12) + 
            ($this->subscriptions()->active()->semiannually()->pluck('amount')->sum() * 2) + 
            $this->subscriptions()->active()->annually()->pluck('amount')->sum()
        );
    }

    public function getFormattedMonthlySubscriptionCost()
    {
        $money = $this->createMoneyFromMinor($this->getMinorCostOfActiveMonthlySubscriptions());
        return $money->formatTo('en_US');
    }

    public function getFormattedAnnualSubscriptionCost()
    {
        $money = $this->createMoneyFromMinor($this->getMinorCostOfAllActiveSubscriptionsAnnually());
        return $money->formatTo('en_US');
    }

    private function createMoneyFromMinor($minorAmount, $currency = 'USD', $context = null, $roundingMode = RoundingMode::DOWN)
    {
        return Money::ofMinor(
            $minorAmount,
            $currency,
            $context,
            $roundingMode
        );
    }
}
