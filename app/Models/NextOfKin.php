<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NextOfKin extends Model
{
     use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'relationship',
        'id_number',
        'phone_number',
        'email',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
