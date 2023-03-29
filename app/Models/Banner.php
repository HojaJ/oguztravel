<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['filename', 'order', 'title', 'subtitle', 'link'];

    public $translatable = ['title', 'subtitle'];

    public function getImage()
    {
        return asset('storage/banners/' . $this->filename);
    }
}
