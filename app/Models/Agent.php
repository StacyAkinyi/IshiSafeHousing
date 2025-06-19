<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
     use HasFactory;
    protected $fillable = ['user_id', 'phone_number', 'license_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
