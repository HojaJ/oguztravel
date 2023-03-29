<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutImage extends Model
{
    use HasFactory;

    protected $fillable = ['about_id', 'filename', 'order'];

    public function about()
    {
        return $this->belongsTo(About::class);
    }

    public function getImage()
    {
        return asset('storage/about/' . $this->filename);
    }
}
