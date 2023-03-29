<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceRequestFile extends Model
{
    use HasFactory;

    protected $fillable = ['service_request_id', 'filename', 'type'];

    public function service()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function getFile()
    {
        return asset('storage/service_request_files/' . $this->filename);
    }
}
