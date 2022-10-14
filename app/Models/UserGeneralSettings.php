<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGeneralSettings extends Model
{
    use HasFactory;

    /**
     * The model's default attributes
     */
    protected $attributes = [
        'theme' => 'dark'
    ];

    protected $fillable = [
        'theme'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
