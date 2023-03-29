<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'slug',
        'data',
        'locale_data',
        'type',
        'icon',
        'is_active',
    ];

    public $translatable = ['locale_data'];
}
