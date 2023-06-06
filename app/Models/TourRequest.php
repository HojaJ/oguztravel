<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TourRequest extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ['name', 'surname','note', 'patronymic', 'email', 'phone', 'date_of_birth', 'applicant_type', 'filename', 'file_type', 'type', 'tour_id','gender'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function getFile()
    {
        $array = [];
        if(is_null($this->filename)){
            return $array;
        }
        foreach (json_decode($this->filename) as $file){
            $new['filename'] = asset('storage/scanned_passport_file/' . $file->filename);
            $new['type'] = $file->file_type;
            $array[] = $new;
        }
        return $array;
    }
}
