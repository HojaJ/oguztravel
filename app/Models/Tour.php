<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Support\Str;

class Tour extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['title', 'type', 'description','price', 'include', 'details', 'category_id','bound','discount_percent','discount_end_time','discount_active'];
    public $translatable = ['title', 'description', 'include', 'details'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tourRequests()
    {
        return $this->hasMany(TourRequest::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function imagesOrderBy()
    {
        return $this->images()->orderBy('order')->get();
    }

    public function firstImage()
    {
        $image = $this->images()->first();

        if ($image) {
            return $image->getImage();
        }

        return '';
    }

    public function summary90()
    {
        $description = $this->description;
        $description = strip_tags($description);
        $description = html_entity_decode($description);
        $description = trim($description, "\t\n\r\0\x0B\xC2\xA0");
        $description = Str::limit($description, 90);

        return $description;
    }

}
