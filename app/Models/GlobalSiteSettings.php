<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalSiteSettings extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_enabled',
        'show_home_page'
    ];

    public static function get()
    {
        $settings = GlobalSiteSettings::first();
        if (is_null($settings)) {
            $settings = GlobalSiteSettings::create();
        }

        return $settings;
    }
}
