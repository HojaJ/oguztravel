<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class About extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'subtitle', 'desc'];
    public $translatable = ['title', 'subtitle', 'desc'];

    public function images()
    {
        return $this->hasMany(AboutImage::class);
    }

    public function imagesOrderBy()
    {
        return $this->images()->orderBy('order')->get();
    }
}
