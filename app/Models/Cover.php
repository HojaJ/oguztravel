<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Cover extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['slug', 'subtitle', 'filename', 'is_active'];
    public $translatable = ['subtitle'];

    public function getImage()
    {
        return asset('storage/covers/' . $this->filename);
    }
}
