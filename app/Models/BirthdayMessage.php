<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class BirthdayMessage extends Model
{
    use HasFactory;

    protected $fillable = ['lang', 'content'];
    protected $table = 'birthday_messages';
}
