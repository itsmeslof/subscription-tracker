<?php

namespace App\Models;

use Brick\Math\RoundingMode;
use Brick\Money\Context\DefaultContext;
use Brick\Money\Money;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Subscription extends Model
{
    use HasFactory, HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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

    public function getFullAmountAsDecimal()
    {
        $money = Money::ofMinor(
            $this->amount,
            'USD',
            null,
            Roundingmode::DOWN
        );

        return $money->getAmount();
    }

    public function scopeActive($query)
    {
        return $query->where('cancelled', false);
    }

    public function scopeCancelled($query)
    {
        return $query->where('cancelled', true);
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

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['status'] ?? false, function ($query, $status) {
            $query->where('cancelled', $status === 'cancelled');
        }, function ($query) {
            $query->where('cancelled', false);
        })->when($filters['cycle'] ?? null, function ($query, $cycle) {
            $billingCycle = BillingCycle::where('name', $cycle)->first();
            if (!$billingCycle) {
                return;
            }

            $query->where('billing_cycle_id', $billingCycle->id);
        });
    }
}
