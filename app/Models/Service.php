<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Service extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['slug', 'title', 'subtitle', 'is_active', 'filename'];
    
    public $translatable = ['title', 'subtitle'];

    public function getImage()
    {
        return asset('storage/services/' . $this->filename);
    }
}
