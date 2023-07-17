<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    use HasFactory;
    protected $fillable = ['name','mail','date','category'];

    public function email()
    {
        return $this->belongsTo(Email::class,'mail','id');
    }
}
