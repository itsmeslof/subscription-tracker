<?php

namespace App\Models;

use Brick\Math\RoundingMode;
use Brick\Money\Context\DefaultContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'billing_cycle_id',
        'color',
        'cancelled'
    ];

    public function billingCycle()
    {
        return $this->belongsTo(BillingCycle::class);
    }

    public function getFormattedPrice()
    {
        $money = Money::ofMinor(
            $this->amount,
            'USD',
            new DefaultContext(),
            RoundingMode::DOWN
        );

        return $money->formatTo('en_US');
    }

    public function scopeActive($query)
    {
        return $query->where('cancelled', false);
    }

    public function scopeMonthly($query)
    {
        return $query->where('billing_cycle_id', BillingCycle::where('name', 'monthly')->value('id'));
    }

    public function scopeSemiannually($query)
    {
        return $query->where('billing_cycle_id', BillingCycle::where('name', 'semiannually')->value('id'));
    }

    public function scopeAnnually($query)
    {
        return $query->where('billing_cycle_id', BillingCycle::where('name', 'annually')->value('id'));
    }
}
