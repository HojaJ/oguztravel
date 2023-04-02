<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'applicant_type',
        'country',
        'city',
        'booking_date_from',
        'booking_date_to',
        'room_type',
        'adult_qty',
        'child_qty',
        'ticket_from',
        'ticket_to',
        'ticket_type',
        'boarding_date_from',
        'boarding_date_to',
        'planned_date_from',
        'planned_date_to',
        'name',
        'surname',
        'patronymic',
        'email',
        'phone',
        'date_of_birth',
        'passport_info_type',
        'passport_number',
        'expiry_date',
        'scanned_passport',
        'scanned_passport_file_type',
        'note',
        'type',
        'is_read',
        'gender'
    ];

    public function files()
    {
        return $this->hasMany(ServiceRequestFile::class);
    }

    public function getDocPhotoFiles()
    {
        return $this->files()->whereType('doc_photos')->get();
    }

    public function getExtraDocFiles()
    {
        return $this->files()->whereType('extra_docs')->get();
    }

    public function getScannedDocumentFiles()
    {
        return $this->files()->whereType('scanned_documents')->get();
    }

    public function getFile()
    {

    }

    public function getPassport()
    {
        $array = [];
        foreach (json_decode($this->scanned_passport) as $file){
            $new['filename'] = asset('storage/scanned_passport_file/' . $file->filename);
            $new['type'] = $file->file_type;
            $array[] = $new;
        }
        return $array;
    }
}
