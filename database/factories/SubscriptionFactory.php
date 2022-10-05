<?php

namespace Database\Factories;

use App\Models\BillingCycle;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'amount' => fake()->randomNumber(5, false),
            'billing_cycle_id' => fake()->randomElement(BillingCycle::all()->pluck('id')->all()),
            'color' => fake()->hexColor(),
            'user_id' => User::first()->id
        ];
    }

    public function cancelled()
    {
        return $this->state(fn (array $attributes) => [
            'cancelled' => true,
        ]);
    }
}
