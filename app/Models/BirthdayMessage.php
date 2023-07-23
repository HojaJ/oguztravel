<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BirthdayMessage extends Model
{
    use HasFactory;

    protected $fillable = ['name','tm', 'ru','en','zh'];
    protected $table = 'birthday_messages';
}
