<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['phone', 'email', 'name', 'surname', 'patronymic', 'date_of_birth','gender'];
}
