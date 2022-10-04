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
}
