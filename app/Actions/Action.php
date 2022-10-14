<?php

namespace App\Actions;

class Action
{
    public static function call($class, ...$params)
    {
        return resolve($class)->execute(...$params);
    }
}
