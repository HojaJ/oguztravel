<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourRequest extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'surname', 'patronymic', 'email', 'phone', 'date_of_birth', 'applicant_type', 'filename', 'file_type', 'type', 'tour_id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getFile()
    {
        return asset('storage/tour_requests/' . $this->filename);
    }
}
