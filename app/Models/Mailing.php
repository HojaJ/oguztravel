<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailing extends Model
{
    use HasFactory;
    protected $fillable = ['name','mail','date','category','status','type','message','sms_id','lang_type'];

    public function email()
    {
        return $this->belongsTo(Email::class,'mail','id');
    }

    public function sms()
    {
        return $this->belongsTo(BirthdayMessage::class,'sms_id','id');
    }

    protected $casts = [
        'lang_type' => 'json'
    ];
}
