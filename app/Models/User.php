<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Helpers\MoneyHelper;
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
        'total_monthly_minor_cost',
        'total_annual_minor_cost'
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
     * Get the cost of the user's active monthly subscriptions as a formatted currency string.
     *
     * @return string
     */
    public function getFormattedMonthlyCostAttribute(): string
    {
        return MoneyHelper::formatMinor($this->total_monthly_minor_cost);
    }

    /**
     * Get the annual cost of the user's active subscriptions as a formatted currency string.
     *
     * @return string
     */
    public function getFormattedAnnualCostAttribute(): string
    {
        return MoneyHelper::formatMinor($this->total_annual_minor_cost);
    }
}
