<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'school_id',
        'full_name',
        'student_id',
        'email',
        'phone'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
