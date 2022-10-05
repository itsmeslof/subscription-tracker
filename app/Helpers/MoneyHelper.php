<?php

namespace App\Helpers;

use Brick\Math\RoundingMode;
use Brick\Money\Money;

class MoneyHelper
{
    public static function createMoneyOfMinor($minorAmount, $currency = 'USD', $context = null, $roundingMode = RoundingMode::DOWN): Money
    {
        return Money::ofMinor(
            $minorAmount,
            $currency,
            $context,
            $roundingMode
        );
    }

    public static function createMoney($amount, $currency = 'USD', $context = null, $roundingMode = RoundingMode::DOWN): Money
    {
        return Money::of(
            $amount,
            $currency,
            $context,
            $roundingMode
        );
    }
}
