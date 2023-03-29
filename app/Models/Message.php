<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'surname', 'email', 'phone', 'message', 'subject_id', 'is_read'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
