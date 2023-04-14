<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title','email','type'];
    public $translatable = ['title'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
