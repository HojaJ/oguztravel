<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailHistory extends Model
{
    use HasFactory;
    protected $fillable = ['to','sent_time','type','content'];

    public $timestamps = false;

    public function email()
    {
        return $this->belongsTo(Email::class,'content','id');
    }

}
