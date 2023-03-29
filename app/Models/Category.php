<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name'];
    public $translatable = ['name'];

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
